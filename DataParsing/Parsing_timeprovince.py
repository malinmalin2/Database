import getpass

import pymysql as mysqldb



mydb = mysqldb.connect(host='127.0.0.1',user='root',passwd='******',db='team4')
cursor = mydb.cursor()


fname = 'K_COVID19.csv'
fname2 = 'addtional_Timeinfo.csv'


pro=["Seoul","Gyeonggi-do","Incheon","Gangwon-do","Chungcheongbuk-do",
         "Chungcheongnam-do","Daejeon","Sejong","Jeollabuk-do",
         "Jeollanam-do","Gwangju","Gyeongsangbuk-do","Daegu",
         "Gyeongsangnam-do","Busan","Ulsan","Jeju-do"]
c_province=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
r_province=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]    
d_province=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    
for ldx, line in enumerate(open(fname2)):
    print(line)
    if not ldx:
        print("not ldx")
        continue
    
    tok2 = line.strip().split(',')
    date=tok2[0]

    #0:Seoul,1:Gyeonggi-do,2:Incheon,3:Gangwon-do,4:Chungcheongbuk-do
    #5:Chungcheongnam-do,6:Daejeon,7:Sejong,8:Jeollabuk-do
    #9:Jeollanam-do,10:Gwangju,11:Gyeongsangbuk-do,12:Daegu
    #13:Gyeongsangnam-do,14:Busan,15:Ulsan,16:Jeju-do

    
    for ldx, line in enumerate(open(fname)):
        if not ldx:
            print("not ldx")
            continue
        
        tok = line.strip().split(',')
        province=tok[4]
        confirmed_date=tok[10]
        released_date=tok[11]
        decreased_date=tok[12]

        i=0
        if date==confirmed_date:
            while i<=15:
                if(province==pro[i]):
                    c_province[i]+=1
                i+=1

        i=0
        if date==released_date:
            while i<=15:
                if(province==pro[i]):
                    r_province[i]+=1
                i+=1
                
        i=0
        if date==decreased_date:
            while i<=15:
                if(province==pro[i]):
                    d_province[i]+=1
                i+=1

    i=0
    while i<=15:
        timeprovince_vals = "%s, %s, %d, %d, %d" % ('"{}"'.format(date), '"{}"'.format(pro[i]), c_province[i],r_province[i],d_province[i])
        sql = 'INSERT INTO TIMEPROVINCE VALUES (%s)' % (timeprovince_vals)
        try:
            cursor.execute(sql)
            print("Inserting TIMEPROVINCE [%s, %s, %d, %d, %d]" % ('"{}"'.format(date), '"{}"'.format(pro[i]), c_province[i],r_province[i],d_province[i]))
        except mysqldb.IntegrityError:
            print("%s already in TIMEROVINCE" % (date))
        i=i+1



    mydb.commit()
    continue



# close the connection to the database.
cursor.close()
print("Done")
