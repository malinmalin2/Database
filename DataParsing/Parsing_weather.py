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
        region_code = int(tok[23].strip())
    except ValueError:
        region_code = 0

    if region_code == 0:
        continue

    province = tok[4]
    wdate = tok[10]

    try:
        avg_temp = float(tok[14].strip())
    except ValueError:
        avg_temp = 0

    try:
        main_temp = float(tok[15].strip())
    except ValueError:
        main_temp = 0

    try:
        max_temp = float(tok[16].strip())
    except ValueError:
        max_temp = 0


    weather_vals = "%d, %s, %s, %.1f, %.1f, %.1f" % (region_code, '"{}"'.format(province),'"{}"'.format(wdate),
                                                    avg_temp,
                                                    main_temp,
                                                    max_temp
                                                    )

    sql = 'INSERT INTO WEATHER VALUES (%s)' % (weather_vals)
    try:
        cursor.execute(sql)
        print("Inserting WEATHER [%d, %s, %s, %.1f, %.1f, %.1f]" % (region_code, '"{}"'.format(province),'"{}"'.format(wdate),
                                                                                            avg_temp,
                                                                                            main_temp,
                                                                                            max_temp))
    except mysqldb.IntegrityError:
        print("%d %s already in WEATHER" % (region_code, wdate))

    mydb.commit()
    continue

cursor.close()
print("Done")
