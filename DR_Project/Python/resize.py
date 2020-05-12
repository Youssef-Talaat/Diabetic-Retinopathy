import cv2

img_path = ""
image_dimension = 224
img = cv2.imread(img_path)
img_resized = cv2.resize(img, (image_dimension, image_dimension))
cv2.imwrite("ImageName", img_resized)

