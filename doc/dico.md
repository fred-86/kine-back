# Dictionnaires des données

## Back
## Entity Patient

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| patient id|
|lastName|VarChar(128)|Not Null|lastname of patient|
|firstName|VarChar(128)|Not Null|firstname of patient|
|email|VarChar(180)|Not Null, unique|email of patient|
|password|VarChar(255)|Not Null|password of patient|
|phone|VarChar(15)|Not Null|phone of patient|
|address|VarChar(255)|Not Null|address of patient|
|city|VarChar(64)|Not Null|city of patient|
|zipCode|VarChar(7)|Not Null|city of patient|
|role|VarChar(120)|Not Null Default patient|role (DC2Type:json)|
|user|entity|Not Null, foreign key |user of appointments|
|created_at|DateTime|Not Null,ON UPDATE|date of patient creation|
|updated_at|DateTime|Null,ON UPDATE|date of patient update|

## Entity Appointment

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| appointment id|
|date|DateTime|Not Null|date of appoitment|
|time|Time|Not Null|time of appoitment|
|topic |ENUM|Not Null|topic of appoitment (kinésiologie, soins énergétiques, purification de lieux)|
|comment|LongText| Null|comment of appotment|
|notification|Boolean| Null default 0|notification if there are appointments available|
|user|entity|Not Null, foreign key |user of appointments|
|patient|entity|Not Null, foreign key patient of appointments|
|status|entity|Not Null, foreign key|status of appointments|
|created_at|DateTime|Not Null,ON UPDATE|date of user creation|
|updated_at|DateTime|Null,ON UPDATE|date of user update|


## Entity status

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| status id|
|worded |ENUM| Null, Default confirmé|worded of appoitment (en attente, confirmé, annulé)|
|created_at|DateTime|Not Null,ON UPDATE|date of user creation|
|updated_at|DateTime|Null,ON UPDATE|date of user update|


## Entity user (admin)

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| user id|
|email|VarChar(180)|Not Null, unique|email of user|
|password|VarChar(255)|Not Null|password of user|
|phone|VarChar(15)|Not Null|phone of user|
|role|VarChar(120)|Not Null Default admin|role (DC2Type:json)|
|created_at|DateTime|Not Null,ON UPDATE|date of user creation|
|updated_at|DateTime|Null,ON UPDATE|date of user update|

## Entity review (patient)

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| practitioner id|
|Content|LongText|Not Null|content of review|
|status|smallint|Not Null, unsigned default 1|status of review (0=actif, 1=inactif)|
|patient|entity|Not Null, foreign key |the patient's review|
|created_at|DateTime|Not Null,ON UPDATE|date of review creation|
|updated_at|DateTime|Null,ON UPDATE|date of review update|
|published_at|DateTime|Null,ON UPDATE|date of review publication|

## Entity Availability 

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| practitioner id|
|reason|VarChar(50)|Null|reason  of availability|
|start_dateTime|dateTime| Null| start to availability|
|end_dateTime|dateTime| Null| end to availability|
|recurrence|Boolean|Not Null default 1|recurrence for availablility|
|recurrence_days|array|Not Null|Days of the week affected by the unavailability|
|is_working_hours|Boolean|Not Null default 1|Indicator to specify whether the unavailability affects the user's normal working hours|
|days_of_week|array|Not Null|Specific days of the week affected by unavailability|
|user|entity|Not Null, foreign key |the user's availability|
|created_at|DateTime|Not Null,ON UPDATE|date of review creation|
|updated_at|DateTime|Null,ON UPDATE|date of review update|



## Front

## Entity  Practitioner

| Champ|Type|Specifities|Description|
|:------:|:-----:|:------:|:-----:|
|id|Int|Primary Key, Not Null, Unsigned, Auto_Increment| practitioner id|
|lastName|VarChar(128)|Not Null|lastname of Practitioner|
|firstName|VarChar(128)|Not Null|firstname of Practitioner|
|phone|VarChar(15)|Not Null|phone of Practitioner|
|address|VarChar(255)|Not Null|address of Practitioner|
|city|VarChar(64)|Not Null|city of Practitioner|
|zipCode|VarChar(7)|Not Null|city of Practitioner|
|email|VarChar(180)|Not Null, unique|email of Practitioner|
|link|VarChar(620)| Null|link of Practitioner|
|role|VarChar(120)|Not Null Default admin|role (DC2Type:json)|
|created_at|DateTime|Not Null,ON UPDATE|date of Practitioner creation|
|updated_at|DateTime|Null,ON UPDATE|date of Practitioner update|


