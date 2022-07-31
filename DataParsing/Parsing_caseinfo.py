import getpass

import pymysql as mysqldb

mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()

fname = 'K_COVID19.csv'

for ldx, line in enumerate(open(fname)):
    print(line)
    if not ldx:
        print("not ldx")
        continue

    tok = line.strip().split(',')

    try:
        case_id = int(tok[17])
    except ValueError:
        case_id = 0


    province = tok[4]
    city = tok[18]

    try:
        infection_group = int(tok[19].strip())
    except ValueError:
        infection_group = -1

    infection_case = tok[6]

    try:
        confirmed = int(tok[20].strip())
    except ValueError:
        confirmed = 0

    try:
        latitude = float(tok[21].strip())
    except ValueError:
        latitude = 0

    try:
        longitude = float(tok[22].strip())
    except ValueError:
        longitude = 0

    if case_id == 0:
        continue


    Case_vals = "%d, %s, %s, %d, %s, %d, %.4f, %.3f" % (case_id, '"{}"'.format(province), '"{}"'.format(city),
                                            infection_group,
                                            '"{}"'.format(infection_case),
                                          confirmed,
                                            latitude,
                                            longitude
                                          )

    sql = 'INSERT INTO CASEINFO VALUES (%s)' % (Case_vals)

    try:
        cursor.execute(sql)
        print("Inserting CASEINFO [%d, %s, %s, %d, %s, %d, %.4f, %.3f]" % (case_id, province, city,
                                            infection_group,
                                            infection_case,
                                          confirmed,
                                            latitude,
                                            longitude))
    except mysqldb.IntegrityError:
        print("%d already in CASEINFO" % (case_id))

    mydb.commit()


cursor.close()
print("Done")
