from rs import SA
from item import Item
from random import shuffle
from datetime import datetime
import json
import math

import mysql.connector

def log(message, end=None):
    print(message, flush=True, end=end)


if __name__ == '__main__':
    # datasets = [
    #     {"name": "" , "type": 0, "results" :{}},    
    # ]
    datasets = list()

    mydb=mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="optim"
    )
    if mydb.is_connected():
         print("Successfully connected !")

    cursor = mydb.cursor()
    query = ("SELECT id,nom_instance, type_instance FROM resultats "
         "WHERE 1")
    cursor.execute(query)
    i=0
    for (id, nom_instance, type_instance) in cursor:
        nom=format(nom_instance)
        type_ins=format(type_instance)
        # print(nom)
        # print(type_ins)
        number_tuple = {"id" :format(id),"name" :format(nom), "type": format(type_ins),"results": {},"capacite":0,"nombre_objets":0,
        "poids_min":0,"poids_moyen":0,"poids_max":0}
        datasets.insert(i,number_tuple)
        i=i+1


    # Loop through each data set.
    for dataset in datasets:
        # Read the data into memory
        if format(dataset["type"]) == '0':
            with open('assets/Scholl/Scholl_1/{}'.format(dataset["name"]), 'r') as file:
                data = file.read().splitlines()
                num_items, capacity, items = int(data[0]), int(data[1]), data[2:]
        
        if format(dataset["type"]) == '1':
            with open('assets/Scholl/Scholl_2/{}'.format(dataset["name"]), 'r') as file:
                data = file.read().splitlines()
                num_items, capacity, items = int(data[0]), int(data[1]), data[2:]
        
        if format(dataset["type"]) == '2':
            with open('assets/Scholl/Scholl_3/{}'.format(dataset["name"]), 'r') as file:
                data = file.read().splitlines()
                num_items, capacity, items = int(data[0]), int(data[1]), data[2:]

        if format(dataset["type"]) == '3':
            with open('assets/Falkenauer/Falkenauer U/{}'.format(dataset["name"]), 'r') as file:
                data = file.read().splitlines()
                num_items, capacity, items = int(data[0]), int(data[1]), data[2:]

        if format(dataset["type"]) == '4':
            with open('assets/Falkenauer/Falkenauer_T/{}'.format(dataset["name"]), 'r') as file:
                data = file.read().splitlines()
                num_items, capacity, items = int(data[0]), int(data[1]), data[2:]

        
        items = [Item(size=int(i)) for i in items]
        # Perform 30 independent iterations.
        for iteration in range(1):
            # Randomize the order of the items in the item list.
            shuffle(items)
            sa = SA(0.7,capacity,items,500,10,8)
            start_time = datetime.now()
            sa.run()
            execution_time = datetime.now() - start_time

            # Record the relevant data for analysis
            summary = {
                "execution_time": str(execution_time.total_seconds()),
                "num_bins": len(sa.bins),
            }

            dataset["results"].setdefault("SA", []).append(summary)
            nom = dataset["name"]
            dataset["capacite"]=capacity
            dataset["nombre_objets"]=num_items
            if format(dataset["type"]) == '0':
                if nom[4:6] == "W1":
                    poids_min = 1
                    poids_max = 100
                if nom[4:6] == "W2":
                    poids_min = 20
                    poids_max = 100
                if nom[4:6] == "W3":
                    poids_min = 30
                    poids_max = 100
                
                dataset["poids_min"] = poids_min
                dataset["poids_max"] = poids_max
            
            if format(dataset["type"]) == '1' :
                if nom[2:4] == "W1":
                    poids_moyen = math.floor(capacity/3)
                if nom[2:4] == "W2":
                    poids_moyen = math.floor(capacity/5)
                if nom[2:4] == "W3":
                    poids_moyen = math.floor(capacity/7)
                if nom[2:4] == "W4":
                    poids_moyen = math.floor(capacity/9)

                dataset["poids_moyen"] = poids_moyen

            if format(dataset["type"]) == '2' :
                  poids_max = 35000
                  poids_min = 20000

            # print(summary.get("num_bins"))
            
            if format(dataset["type"]) == '0' or format(dataset["type"]) == '2':
                add_results = ("UPDATE resultats SET poids_min= %s,poids_max= %s, capacite= %s, nombre_objets= %s, solMet_two= %s, tempsMet_two=%s WHERE id = %s")
                data_add_results = (dataset["poids_min"],dataset["poids_max"],capacity,num_items,summary.get("num_bins"),summary.get("execution_time"),dataset["id"])
            if format(dataset["type"]) == '1':
                add_results = ("UPDATE resultats SET poids_moyen= %s, capacite= %s, nombre_objets= %s, solMet_two= %s, tempsMet_two=%s WHERE id = %s")
                data_add_results = (dataset["poids_moyen"],capacity,num_items,summary.get("num_bins"),summary.get("execution_time"),dataset["id"])

            if format(dataset["type"]) == '3' or format(dataset["type"]) == '4':
                add_results = ("UPDATE resultats SET capacite= %s, nombre_objets= %s, solMet_two= %s, tempsMet_two=%s WHERE id = %s")
                data_add_results = (capacity,num_items,summary.get("num_bins"),summary.get("execution_time"),dataset["id"])
            
            cursor.execute(add_results, data_add_results)
            mydb.commit()
            # print(cursor.rowcount, "record(s) affected")
            #dataset["results"].setdefault("SA", []).append(summary)
    # Write the captured data to disk.
    cursor.close()
    mydb.close()
    #inserting data to Database :DD

