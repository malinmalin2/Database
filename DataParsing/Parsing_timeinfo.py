import getpass

import pymysql as mysqldb



mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()


fname = 'K_COVID19.csv'
fname2 = 'addtional_Timeinfo.csv'

confirmed_sum=0
released_sum=0
decreased_sum=0
    
for ldx, line in enumerate(open(fname2)):
    print(line)
    if not ldx:
        print("not ldx")
        continue


    tok2 = line.strip().split(',')
    date=tok2[0]
    test=int(tok2[1])
    negative=int(tok2[2])


    for ldx, line in enumerate(open(fname)):
            tok = line.strip().split(',')
            confirmed_date=tok[10]
            released_date=tok[11]
            decreased_date=tok[12]

            if date==confirmed_date:
                confirmed_sum+=1

            if date==released_date:
                released_sum+=1

            if date==decreased_date:
                decreased_sum+=1


    # insert data into Timeinfo
    timeinfo_vals = "%s, %d, %d, %d, %d, %d" % ('"{}"'.format(date), test,negative,confirmed_sum, released_sum,decreased_sum)

    sql = 'INSERT INTO TIMEINFO VALUES (%s)' % (timeinfo_vals)
    try:
        cursor.execute(sql)
        print("Inserting TIMEINFO [%s, %d, %d, %d, %d, %d]" % ('"{}"'.format(date), test,negative,confirmed_sum, released_sum,decreased_sum))
    except mysqldb.IntegrityError:
        print("%s already in TIMEINFO" % (date))

    mydb.commit()
    continue


# close the connection to the database.
cursor.close()
print("Done")
