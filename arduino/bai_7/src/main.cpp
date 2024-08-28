#include <Arduino.h>

const int ledPins[3] = {2, 3, 4}; // Các chân điều khiển LED
byte ledControl = 0b000; // Biến để điều khiển ba LED, bắt đầu với tất cả tắt

void setup() {
  for (int i = 0; i < 3; i++) {
    pinMode(ledPins[i], OUTPUT);
  }

  Serial.begin(9600); // Khởi động giao tiếp Serial với baud rate 9600
}

void loop() {
  if (Serial.available() > 0) {
    char incomingChar = Serial.read(); // Đọc ký tự đến từ Serial
    ledControl = incomingChar & 0b00000111; // Chỉ lấy ba bit thấp nhất từ giá trị ASCII

    for (int i = 0; i < 3; i++) {
      if (ledControl & (1 << i)) {
        digitalWrite(ledPins[i], HIGH); // Bật LED nếu bit tương ứng là 1
      } else {
        digitalWrite(ledPins[i], LOW); // Tắt LED nếu bit tương ứng là 0
      }
    }
  }
}
