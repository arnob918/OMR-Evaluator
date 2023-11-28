import sys
from email import iterators
result = sys.argv[1]
rows = sys.argv[2]

import cv2 as cv
import numpy as np
import define
def main():
    q=31 
    c=5
    q3=11
    c3=7

    path = "../Opencv/Photos/" + result
    #print(path)
    img=cv.imread(path)
    # print(img.shape)
    # cv.imshow('Actual image',img)
    

    inst = define.func
    #resized_img = inst.rescaleFrame(img)
    resized_img = cv.resize(img,(600,800))
    # print(resized_img.shape)
    # cv.imshow('reshapedOmr', resized_img)
    
    gray=cv.cvtColor(resized_img, cv.COLOR_BGR2GRAY)
  
    # cv.imshow('gray',gray)
    
    blur=cv.GaussianBlur(gray,(3,3),cv.BORDER_DEFAULT)
  
    #blur=cv.GaussianBlur(resized_img,(7,7),cv.BORDER_DEFAULT)
    # cv.imshow('blured',blur)

    canny=cv.Canny(blur,50,100)
    # cv.imshow('canny',canny)

    #dilated=cv.dilate(canny,(7,7),iterations=3)
    #cv.imshow('dilated',dilated)
    #resized=cv.resize(img,(500,500))
    #cv.imshow('resized',resized)
    #crop=resized_img[100:400,100:500]
    #cv.imshow('cropped',crop)
    imgcpy=resized_img.copy()
    imgcpy2=gray.copy()
   
    contours,hierarchy=cv.findContours(canny,cv.RETR_EXTERNAL,cv.CHAIN_APPROX_NONE)
   

    cv.drawContours(imgcpy,contours,-1,(0,255,0),3)
    
    
    rectcorners=inst.findcont(contours)
   
   

    
    cv.drawContours(imgcpy,rectcorners,-1,(255,0,0),3)
    Areas=[]
    for i in range(0,4):
        #print(i,"th rect\n")
        rect=inst.getcorners(rectcorners[i])
        area=inst.RectArea(rect)
        Areas.append(area)
        
    # for i in Areas:
    #     print(i)

    cv.drawContours(imgcpy,rectcorners[0],-1,(0,0,255),3)
    cv.drawContours(imgcpy,rectcorners[3],-1,(0,0,255),3)
    # cv.imshow('contours',imgcpy)
    mxcontour=inst.getcorners(rectcorners[0])
    mxcontour3=inst.getcorners(rectcorners[3])
    
    if mxcontour.size!=0 and mxcontour3.size!=0 :
        
        #fourcorners=cv.drawContours(imgcpy,mxcontour,-1,(255,0,0),10)
        #cv.imshow('four_corners',fourcorners)
        mxcontour=inst.reorder(mxcontour)
        mxcontour3=inst.reorder(mxcontour3)
        #print(mxcontour)
        pt1=np.float32(mxcontour)
        pt2=np.float32([[0,0],[400,0],[0,620],[400,620]])
       
        matrix=cv.getPerspectiveTransform(pt1,pt2)
      
        imgwarpcolored=cv.warpPerspective(imgcpy2,matrix,(400,620))
       
        # cv.imshow('part img',imgwarpcolored)
        imgthresh=cv.threshold(imgwarpcolored,75,255,cv.THRESH_BINARY_INV)[1]
        # print(imgthresh.shape)
        # cv.imshow('threshold',imgthresh)
        boxes=inst.splitboxes(imgthresh,q,c)
        arr=np.zeros((q,c))
       
        i=0
        j=0
        for k in boxes:
            totpix=cv.countNonZero(k)
            arr[i][j]=totpix
            j+=1
            if(j==c):
                j=0
                i+=1
      
        #print(arr)
        data = {}
        for i in range(0,q):
            mx=0
            for j in range(1,c):
                if arr[i][j]>mx:
                    mx=arr[i][j]
            for j in range(1,c):
                if arr[i][j] < mx + 50 and arr[i][j] > mx-50:
                    arr[i][j]=1
                else :
                    arr[i][j]=0
       
        # print("input omr \n")
        for i in range(1,q):

            mx_c = 0
            for j in range(1,c):
                if(arr[i][j] == 1):
                    mx_c+=1
            if(mx_c != 1):
                st = "qu"+str(i)
                data[st] = chr(ord('A')+23)
                continue
            for j in range(1,c):
                if(arr[i][j] == 1):
                    st = "qu"+str(i)
                    data[st] = chr(ord('A')+j-1)
                    break

        pt31=np.float32(mxcontour3)
        pt32=np.float32([[0,0],[350,0],[0,550],[350,550]])
       
        matrix3=cv.getPerspectiveTransform(pt31,pt32)
      
        imgwarpcolored3=cv.warpPerspective(imgcpy2,matrix3,(350,550))
       
        # cv.imshow('part roll img',imgwarpcolored3)
        imgthresh3=cv.threshold(imgwarpcolored3,75,255,cv.THRESH_BINARY_INV)[1]
        # print(imgthresh3.shape)
        # cv.imshow('threshold roll',imgthresh3)
        boxes3=inst.splitboxes(imgthresh3,q3,c3)
        arr3=np.zeros((q3,c3))
        i=0
        j=0
        for k in boxes3:
            totpix=cv.countNonZero(k)
            arr3[i][j]=totpix
            j+=1
            if(j==c3):
                j=0
                i+=1
      
        # print(arr3)
        roll = ""
        for j in range(0,c3):
            mx=0
            for i in range(1,q3):
                if arr3[i][j]>mx:
                    mx=arr3[i][j]
            for i in range(1,q3):
                if arr3[i][j]==mx:
                    arr3[i][j]=1
                else :
                    arr3[i][j]=0
       
        # print("input roll \n")
        for j in range(0,c3):
            
                
                for i in range(1,q3):
                    if arr3[i][j] == 1:
                        roll+=(str((i-1)))
                        break
                # print(" line ",i," ended\n")
    
    data['roll'] = roll
    print(data)
    # cv.waitKey(0)
    exit
        
if __name__ == "__main__":
    main()