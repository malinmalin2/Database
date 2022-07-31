import getpass

import pymysql as mysqldb



mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()


fname = 'K_COVID19.csv'
fname2 = 'addtional_Timeinfo.csv'

c_age=[0,0,0,0,0,0,0,0,0,0]
d_age=[0,0,0,0,0,0,0,0,0,0]

for ldx, line in enumerate(open(fname2)):
    print(line)
    if not ldx:
        print("not ldx")
        continue
    
    tok2 = line.strip().split(',')
    date=tok2[0]

    ages=['10s','20s','30s','40s','50s','60s','70s','80s','90s','100s']
    
    for ldx, line in enumerate(open(fname)):
        if not ldx:
            print("not ldx")
            continue
        
        tok = line.strip().split(',')
        age=tok[2]
        confirmed_date=tok[10]
        decreased_date=tok[12]

        i=0
        if date==confirmed_date:
            while(i<=9):
                if(age==ages[i]):
                    c_age[i]+=1
                i+=1

        i=0
        if date==decreased_date:
            while(i<=9):
                if(age==ages[i]):
                    d_age[i]+=1
                i+=1

    i=0
    while i<=9:
        timeage_vals = "%s, %s, %d, %d" % ('"{}"'.format(date), '"{}"'.format(ages[i]), c_age[i],d_age[i])
        sql = 'INSERT INTO TIMEAGE VALUES (%s)' % (timeage_vals)
        try:
            cursor.execute(sql)
            print("Inserting TIMEAGE [%s, %s, %d, %d]" % ('"{}"'.format(date), '"{}"'.format(ages[i]), c_age[i],d_age[i]))
        except mysqldb.IntegrityError:
            print("%s already in TIMEAGE" % (date))
        i+=1



    mydb.commit()
    continue



# close the connection to the database.
cursor.close()
print("Done")
