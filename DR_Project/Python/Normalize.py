import cv2
import sys

img_path = sys.argv[1]
image_dimension = 224
img = cv2.imread(img_path)
img_resized = cv2.resize(img, (image_dimension, image_dimension))
cv2.imwrite(img_path, img_resized)
