import getpass

import pymysql as mysqldb


mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()

fname = 'K_COVID19.csv'
for ldx, line in enumerate(open(fname)):
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

    # insert data into Patient
    Patient_vals = "%d, %s, %s, %s, %s, %s, %s, %d, %d, %s, %s, %s, %s, %s" % (patient_id,'"{}"'.format(sex), '"{}"'.format(age),'"{}"'.format(country),
                                                                               '"{}"'.format(province),'"{}"'.format(city),'"{}"'.format(infection_case),
                                                                               infected_by,contact_number,'"{}"'.format(symptom_onset_date),'"{}"'.format(confirmed_date),
                                                                               '"{}"'.format(released_date),'"{}"'.format(decreased_date),'"{}"'.format(state))

    sql = 'INSERT INTO PATIENTINFO VALUES (%s)' % (Patient_vals)
    try:
        cursor.execute(sql)
        print("Inserting PATIENTINFO [%d, %s, %s, %s, %s, %s, %s, %d, %d, %s, %s, %s, %s, %s]" % (patient_id, sex, age,
                                            country,
                                            province,
                                            city,
                                           infection_case,
                                          infected_by,
                                          contact_number,
                                          symptom_onset_date,
                                          confirmed_date,
                                          released_date,
                                          decreased_date,
                                            state))
    except mysqldb.IntegrityError:
        print("%s already in PATIENTINFO" % (patient_id))

    mydb.commit()
    continue

# close the connection to the database.
cursor.close()
print("Done")
