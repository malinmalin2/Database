import getpass

import pymysql as mysqldb

mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()

current=[0 for j in range(44)]

fname = 'K_COVID19.csv'

for ldx, line in enumerate(open(fname, encoding='UTF8')):
    count=0
    if not ldx:
        print("not ldx")
        continue
    
    tok = line.strip().split(',')

    patient_id = int(tok[0])
    sex = tok[1]
    age = tok[2]
    country = tok[3]
    province = tok[4]
    city = tok[5]
    infection_case = tok[6]

    try:
        infected_by = int(tok[7].strip())
    except ValueError:
        infected_by=0

    try:
        contact_number = int(tok[8].strip())
    except ValueError:
        contact_number=0
    
    symptom_onset_date = tok[9]
    confirmed_date = tok[10]
    
    released_date = tok[11]
    decreased_date = tok[12]

    state = tok[13]

    A=tok[5] #ex)강서구
    if(tok[5]=='etc'):
        A=tok[4] #ex)서울
        count=1

    fname2 = 'C:\\Users\\KWON\\Desktop\\team4\\Region.csv'

    for ldx, line in enumerate(open(fname2, encoding='UTF8')):
        if not ldx:
            print("not ldx")
            continue

        tok2 = line.strip().split(',')
        if(count==1):
            if(A==tok2[1]):
                latitude=float(tok2[3])
                longtitude=float(tok2[4])
                break
        else:
            if(A==tok2[2]):
                latitude=float(tok2[3])
                longtitude=float(tok2[4])
                break

#해당 지역의 위도, 경도 찾음
#이제 최소 거리를 계산해보자!
            
    min=99999
    fname3 = 'C:\\Users\\KWON\\Desktop\\team4\\Hospital.csv'

    for ldx, line in enumerate(open(fname3, encoding='UTF8')):
        if not ldx:
            print("not ldx")
            continue
        tok3 = line.strip().split(',')
        C=int(tok3[0])
        latitude2=float(tok3[4])
        longtitude2=float(tok3[5])

        cal=((latitude-latitude2)*(latitude-latitude2))+((longtitude-longtitude2)*(longtitude-longtitude2))

        if(cal<min):
            if(current[C]==int(tok3[6])):
                continue
            min=cal
            id_found=C

    current[id_found]+=1
    print("병원 id는 %d",id_found)

        # insert data into Patient
    Patient_vals = "%d, %s, %s, %s, %s, %s, %s, %d, %d, %s, %s, %s, %s, %s, %d" % (patient_id,'"{}"'.format(sex), '"{}"'.format(age),'"{}"'.format(country),
                                                                               '"{}"'.format(province),'"{}"'.format(city),'"{}"'.format(infection_case),
                                                                               infected_by,contact_number,'"{}"'.format(symptom_onset_date),'"{}"'.format(confirmed_date),
                                                                               '"{}"'.format(released_date),'"{}"'.format(decreased_date),'"{}"'.format(state),id_found)

    sql = 'INSERT INTO PATIENTINFO VALUES (%s)' % (Patient_vals)
    try:
        cursor.execute(sql)
        print("Inserting PATIENTINFO")
    except mysqldb.IntegrityError:
        print("%s already in PATIENTINFO" % (patient_id))

    mydb.commit()

       

cursor.close()
print("Done")
