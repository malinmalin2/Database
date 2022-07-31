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
        region_code = int(tok[23])
    except ValueError:
        region_code = 0

    if region_code == 0:
        continue

    province = tok[4]
    city = tok[5]

    try:
        latitude = float(tok[24])
    except ValueError:
        latitude = 0

    try:
        longitude = float(tok[25])
    except ValueError:
        longitude = 0

    try:
        elementary_school_count = int(tok[26])
    except ValueError:
        elementary_school_count = 0

    try:
        kindergarden_count = int(tok[27])
    except ValueError:
        kindergarden_count = 0

    try:
        university_count = int(tok[28])
    except ValueError:
        university_count = 0

    try:
        academy_ratio = float(tok[29])
    except ValueError:
        academy_ratio = 0

    try:
        elderly_population_ratio = float(tok[30])
    except ValueError:
        elderly_population_ratio = 0

    try:
        elderly_alone_ratio = float(tok[31])
    except ValueError:
        elderly_alone_ratio = 0

    try:
        nursing_home_count = int(tok[32])
    except ValueError:
        nursing_home_count = 0




    # insert data into region
    Region_vals = "%d, %s, %s, %.4f, %.3f, %d, %d, %d, %.2f, %.2f, %.1f, %d" % (region_code, '"{}"'.format(province), '"{}"'.format(city),
                                            latitude,
                                            longitude,
                                            elementary_school_count,
                                           kindergarden_count,
                                          university_count,
                                          academy_ratio,
                                          elderly_population_ratio,
                                          elderly_alone_ratio,
                                          nursing_home_count
                                          )

    sql = 'INSERT INTO REGION VALUES (%s)' % (Region_vals)
    try:
        cursor.execute(sql)
        print("Inserting REGION [%d, %s, %s, %.4f, %.3f, %d, %d, %d, %.2f, %.2f, %.1f, %d]" % (region_code, province, city,
                                            latitude,
                                            longitude,
                                            elementary_school_count,
                                           kindergarden_count,
                                          university_count,
                                          academy_ratio,
                                          elderly_population_ratio,
                                          elderly_alone_ratio,
                                          nursing_home_count
                                          ))
    except mysqldb.IntegrityError:
        print("%s already in REGION" % (Region_vals))

    mydb.commit()
    continue

cursor.close()
print("Done")
