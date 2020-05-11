import cv2
import numpy as np
import keras

image_dimension = 224
model_yesNo_path = "YesNo_fullModel.h5"
model_stages_path = ""
image_path = "C:/Users/Youssef/PycharmProjects/AlexNet/dataset_resized_2_224/1_left.jpeg"

model_yesNo = keras.models.load_model(model_yesNo_path)
model_stages = keras.models.load_model(model_stages_path)

img = np.zeros((1, image_dimension, image_dimension, 3), dtype='uint8')
img[0] = cv2.imread(image_path)

prediction_yesNo = model_yesNo.predict(img)
prediction_yesNo_max = np.argmax(prediction_yesNo, axis=1)

if prediction_yesNo_max[0] == 0:
    result = prediction_yesNo
    print(result)
elif prediction_yesNo_max[0] == 1:
    prediction_stage = model_stages.predict(img)
    result = prediction_stage
    print(result)
