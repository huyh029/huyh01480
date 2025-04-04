import numpy as np
import rasterio
import matplotlib.pyplot as plt
import os
from skimage import img_as_ubyte

# Đảm bảo thư mục lưu kết quả tồn tại
output_folder = r"C:\xampp\htdocs\Project2\picture\result"
os.makedirs(output_folder, exist_ok=True)

# Đường dẫn file lưu tỷ lệ
ratio_file_path = r"C:\xampp\htdocs\Project2\py\path.txt"

# Đọc ảnh từ các băng tần
def read_band(band_path):
    with rasterio.open(band_path) as band:
        return band.read(1).astype(np.float32)

# Đọc các băng tần từ ảnh Landsat
band2 = read_band(r'C:\xampp\htdocs\Project2\py\picture\band2.tif')  # Blue
band3 = read_band(r'C:\xampp\htdocs\Project2\py\picture\band3.tif')  # Green
band4 = read_band(r'C:\xampp\htdocs\Project2\py\picture\band4.tif')  # Red
band5 = read_band(r'C:\xampp\htdocs\Project2\py\picture\band5.tif')  # NIR
band6 = read_band(r'C:\xampp\htdocs\Project2\py\picture\band6.tif')  # SWIR

# Tránh lỗi chia cho 0 bằng cách thêm giá trị epsilon nhỏ
epsilon = 1e-10

# Tính các chỉ số
NDVI = (band5 - band4) / (band5 + band4 + epsilon)
NDWI = (band3 - band5) / (band3 + band5 + epsilon)
NDBI = (band6 - band5) / (band6 + band5 + epsilon)
BSI  = ((band6 + band4) - (band5 + band2)) / ((band6 + band4) + (band5 + band2) + epsilon)

# Phân loại các đối tượng và tạo ảnh phân loại
classification = np.zeros((NDVI.shape[0], NDVI.shape[1], 3), dtype=np.uint8)

# Gán màu cho từng loại:
# - Thực vật (Xanh lá)
# - Nước (Xanh dương)
# - Đô thị (Đỏ)
# - Đất trống (Vàng)

vegetation_mask = NDVI > 0.2
water_mask = NDWI > 0
urban_mask = NDBI > 0
bare_land_mask = BSI > 0

classification[vegetation_mask] = [0, 255, 0]  # Xanh lá
classification[water_mask] = [0, 0, 255]       # Xanh dương
classification[urban_mask] = [255, 0, 0]       # Đỏ
classification[bare_land_mask] = [255, 225, 0] # Vàng

# Tính tỷ lệ diện tích của từng loại

vegetation_ratio = np.sum(vegetation_mask) 
water_ratio = np.sum(water_mask) 
urban_ratio = np.sum(urban_mask) 
bare_land_ratio = np.sum(bare_land_mask) 
total_pixels = vegetation_ratio+water_ratio+urban_ratio+bare_land_ratio
vegetation_ratio = vegetation_ratio / total_pixels
water_ratio = water_ratio / total_pixels
urban_ratio = urban_ratio / total_pixels
bare_land_ratio = bare_land_ratio / total_pixels

# Ghi tỷ lệ vào file path.txt
with open(ratio_file_path, "w") as file:
    file.write(f"{vegetation_ratio * 100:.2f}\n")
    file.write(f"{water_ratio * 100:.2f}\n")
    file.write(f"{urban_ratio * 100:.2f}\n")
    file.write(f"{bare_land_ratio * 100:.2f}")
# Tạo ảnh RGB từ Landsat (B4, B3, B2)
rgb_image = np.stack((band4, band3, band2), axis=-1)
rgb_image = (rgb_image - np.min(rgb_image)) / (np.max(rgb_image) - np.min(rgb_image))  # Chuẩn hóa về [0,1]
rgb_image = img_as_ubyte(rgb_image)  # Chuyển sang dạng 8-bit để lưu ảnh

# Đường dẫn lưu ảnh
classification_path = os.path.join(output_folder, "classified_image.png")
rgb_path = os.path.join(output_folder, "rgb_image.png")

# Lưu ảnh phân loại
plt.imsave(classification_path, classification)

# Lưu ảnh RGB
plt.imsave(rgb_path, rgb_image)
