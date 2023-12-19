import pandas as pd
import argparse
import json

def Argument():
    parser = argparse.ArgumentParser()
    parser.add_argument('--field', '-f',help='To get Distinct field',required=True)
    args = vars(parser.parse_args())
    return args['field']

def GetDistinctField(data,field):
    #to get unique value and sort the 
    field = sorted(list(set(data[field].values())))
    dataframe = pd.DataFrame(field).T
    print(dataframe.to_json(orient="records")[1:-1])

def GetAllData(dataframe):
    CarData = dataframe.to_json(orient="records")
    print(CarData[1:-1])

field = Argument()
dataframe = pd.read_excel('/home/sanjaysagarlearn/htdocs/Website/CarData.xlsx')

if(field=="*"):
    GetAllData(dataframe)
else:
    dict = dataframe.to_dict()
    GetDistinctField(dict,field)


