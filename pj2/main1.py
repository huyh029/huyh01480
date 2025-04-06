import numpy as np
import rasterio
import matplotlib.pyplot as plt
import os
from skimage import img_as_ubyte

#folder lưu kết quả
output_folder = r"result1"
os.makedirs(output_folder, exist_ok=True)

#file lưu tỷ lệ
ratio_file_path = r"ratio.txt"

def read_band(band_path):
    with rasterio.open(band_path) as band:
        return band.read(1).astype(np.float32)
band2 = read_band(r'picture\LC08_L1TP_023031_20241020_20241029_02_T1_B2.TIF')  # Blue
band3 = read_band(r'picture\LC08_L1TP_023031_20241020_20241029_02_T1_B3.TIF')  # Green
band4 = read_band(r'picture\LC08_L1TP_023031_20241020_20241029_02_T1_B4.TIF')  # Red
band5 = read_band(r'picture\LC08_L1TP_023031_20241020_20241029_02_T1_B5.TIF')  # NIR
band6 = read_band(r'picture\LC08_L1TP_023031_20241020_20241029_02_T1_B6.TIF')  # SWIR

epsilon = 1e-10
NDVI = (band5 - band4) / (band5 + band4 + epsilon)
NDWI = (band3 - band5) / (band3 + band5 + epsilon)
NDBI = (band6 - band5) / (band6 + band5 + epsilon)
BSI  = ((band6 + band4) - (band5 + band2)) / ((band6 + band4) + (band5 + band2) + epsilon)

classification = np.zeros((NDVI.shape[0], NDVI.shape[1], 3), dtype=np.uint8)

plant_mask = NDVI > 0
water_mask = NDWI > 0
urban_mask = NDBI > 0
bare_land_mask = BSI > 0

classification[plant_mask] = [0, 255, 0]  
classification[water_mask] = [0, 0, 255]      
classification[urban_mask] = [255, 0, 0]      
classification[bare_land_mask] = [255, 225, 0] 

plant_ratio = np.sum(plant_mask) 
water_ratio = np.sum(water_mask) 
urban_ratio = np.sum(urban_mask) 
bare_land_ratio = np.sum(bare_land_mask) 
total_pixels = plant_ratio+water_ratio+urban_ratio+bare_land_ratio
plant_ratio = plant_ratio / total_pixels
water_ratio = water_ratio / total_pixels
urban_ratio = urban_ratio / total_pixels
bare_land_ratio = bare_land_ratio / total_pixels

#ghi kết quả tỷ lệ
with open(ratio_file_path, "w") as file:
    file.write(f"{plant_ratio * 100:.2f}\n")
    file.write(f"{water_ratio * 100:.2f}\n")
    file.write(f"{urban_ratio * 100:.2f}\n")
    file.write(f"{bare_land_ratio * 100:.2f}")
    

rgb_image = np.stack((band4, band3, band2), axis=-1)
rgb_image = (rgb_image - np.min(rgb_image)) / (np.max(rgb_image) - np.min(rgb_image))  
rgb_image = img_as_ubyte(rgb_image)  

classification_path = os.path.join(output_folder, "classified_image.png")
rgb_path = os.path.join(output_folder, "rgb_image.png")

# Lưu ảnh phân loại
plt.imsave(classification_path, classification)

# Lưu ảnh RGB
plt.imsave(rgb_path, rgb_image)
