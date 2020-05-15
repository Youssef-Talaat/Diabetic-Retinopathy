import cv2
import numpy as np
import keras
import sys
import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'

image_dimension = 224
model_yesNo_path = "C:/wamp64/www/DR_Project/Python/YesNo_fullModel.h5"
model_stages_path = "C:/wamp64/www/DR_Project/Python/Stages_fullModel.h5"
image_path = sys.argv[1]

model_yesNo = keras.models.load_model(model_yesNo_path)
model_stages = keras.models.load_model(model_stages_path)

img = np.zeros((1, image_dimension, image_dimension, 3), dtype='uint8')
img[0] = cv2.imread(image_path)

prediction_yesNo = model_yesNo.predict(img)
prediction_yesNo_max = np.argmax(prediction_yesNo, axis=1)


if prediction_yesNo_max[0] == 0:
    result = prediction_yesNo
    for i in range(len(result[0])):
        print(",")
        print(result[0][i])

elif prediction_yesNo_max[0] == 1:
    prediction_stage = model_stages.predict(img)
    for i in range(len(prediction_stage[0])):
        print(",")
        print(prediction_stage[0][i])