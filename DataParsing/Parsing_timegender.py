import getpass

import pymysql as mysqldb



mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()


fname = 'K_COVID19.csv'
fname2 = 'addtional_Timeinfo.csv'


gender=["male","female"]

c_gender=[0,0]
d_gender=[0,0]
    
for ldx, line in enumerate(open(fname2)):
    print(line)
    if not ldx:
        print("not ldx")
        continue
    
    tok2 = line.strip().split(',')
    date=tok2[0]
    
    
    for ldx, line in enumerate(open(fname)):
        if not ldx:
            print("not ldx")
            continue
        
        tok = line.strip().split(',')
        sex=tok[1]
        confirmed_date=tok[10]
        decreased_date=tok[12]

        i=0
        if date==confirmed_date:
            while i<=1:
                if(sex==gender[i]):
                    c_gender[i]+=1
                i+=1

        i=0
        if date==decreased_date:
            while i<=1:
                if(sex==gender[i]):
                    d_gender[i]+=1
                i+=1

    i=0
    while i<=1:
        timegender_vals = "%s, %s, %d, %d" % ('"{}"'.format(date), '"{}"'.format(gender[i]), c_gender[i],d_gender[i])
        sql = 'INSERT INTO TIMEGENDER VALUES (%s)' % (timegender_vals)
        try:
            cursor.execute(sql)
            print("Inserting TIMEGENDER [%s, %s, %d, %d]" % ('"{}"'.format(date), '"{}"'.format(gender[i]), c_gender[i],d_gender[i]))
        except mysqldb.IntegrityError:
            print("%s already in TIMEGENDER" % (date))
        i=i+1



    mydb.commit()
    continue



# close the connection to the database.
cursor.close()
print("Done")
