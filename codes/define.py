from email import iterators
import cv2 as cv
import numpy as np
class func:
    def rescaleFrame(frame,scale=0.5):
        width=int(frame.shape[1]*scale)
        height=int(frame.shape[0]*scale)
        dimensions=(width,height)
        return cv.resize(frame,dimensions,interpolation=cv.INTER_AREA)
    def findcont(contours):
        rectcorn=[]
        for i in contours:
            area=cv.contourArea(i)
            #print(area)
            if area>100:
                perim=cv.arcLength(i,True)
                corners=cv.approxPolyDP(i,0.02*perim,True)
                if len(corners)==4:
                    rectcorn.append(i)
        rectcorn=sorted(rectcorn,key=cv.contourArea,reverse=True)

        return rectcorn
    def getcorners(cont):
        perim=cv.arcLength(cont,True)
        corners=cv.approxPolyDP(cont,0.02*perim,True)
        return corners
    def reorder(mypoints):
        mypoints=mypoints.reshape((4,2))
        mypointsnew=np.zeros((4,1,2),np.int32)
        add=mypoints.sum(1)
        #print(mypoints)
        #print(add)
        mypointsnew[0]=mypoints[np.argmin(add)]
        mypointsnew[3]=mypoints[np.argmax(add)]
        diff=np.diff(mypoints,axis=1)
        mypointsnew[1]=mypoints[np.argmin(diff)]
        mypointsnew[2]=mypoints[np.argmax(diff)]
        return mypointsnew
    def splitboxes(img,q,c):
        rows=np.vsplit(img,q)  
        box=[]
        
        for i in rows:
            cols=np.hsplit(i,c) 


            for j in cols:
                box.append(j)

        return box
    def RectArea(rect):
        
        x1=rect[0][0][0]
        x2=rect[1][0][0]
        x3=rect[2][0][0]
        x4=rect[3][0][0]

        y1=rect[0][0][1]
        y2=rect[1][0][1]
        y3=rect[2][0][1]
        y4=rect[3][0][1]
        
        s1=x1*y2+x2*y3+x3*y4+x4*y1
        s2=x2*y1+x3*y2+x4*y3+x1*y4
        area=0.5*abs(s1-s2)
        return area
