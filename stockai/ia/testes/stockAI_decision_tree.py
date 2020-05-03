# -*- coding: utf-8 -*-
"""
Created on Sat May  2 23:21:12 2020

@author: PICHAU
"""


import pandas as pd
import numpy as np

base = pd.read_json('testeCrispa.json')
base_saida = pd.read_json('labelTesteCrispa.json')

previsores= base.iloc[:,0:9].values
classe = base_saida.iloc[:,0:2].values

#alguns algoritmos nao aceitam previsores do tipo string e necessita a conversao
from sklearn.preprocessing import LabelEncoder,OneHotEncoder

label_previsores=LabelEncoder()
#convertendo cada atributo categorico em numerico
#labels=label_previsores.fit_transform(previsores[:,1])
previsores[:,0]=label_previsores.fit_transform(previsores[:,0])
previsores[:,4]=label_previsores.fit_transform(previsores[:,4])
previsores[:,5]=label_previsores.fit_transform(previsores[:,5])
previsores[:,7]=label_previsores.fit_transform(previsores[:,7])


#pode existir inconsistencia ... pois valores nominais categoricos se transforma
#em ordinal ..

onehotencoder= OneHotEncoder(categories='auto', drop=None, sparse=True, dtype='float64', handle_unknown='error')
previsores = onehotencoder.fit_transform(previsores).toarray()


from sklearn.preprocessing import StandardScaler
escalona = StandardScaler()
previsores=escalona.fit_transform(previsores)

from sklearn.model_selection import train_test_split

previsores_treinamento , previsores_teste,classe_treinamento, classe_teste=train_test_split(previsores,classe,test_size=0.25, random_state=0)

from sklearn.tree import DecisionTreeClassifier
classificador=DecisionTreeClassifier(criterion='entropy',random_state=0)
classificador.fit(previsores_treinamento,classe_treinamento)

previsoes=classificador.predict(previsores_teste)

from sklearn.metrics import confusion_matrix,accuracy_score

precisao=accuracy_score(classe_teste,previsoes)

print(precisao)

y_test_non_category = [ np.argmax(t) for t in previsores_teste ]
y_predict_non_category = [ np.argmax(t) for t in previsores_treinamento ]
conf_mat = confusion_matrix(y_test_non_category, y_predict_non_category)

#matriz=confusion_matrix(classe_teste,previsoes)
