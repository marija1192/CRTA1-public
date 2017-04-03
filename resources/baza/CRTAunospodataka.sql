--Stranke
SET @p0='0'; -- id 
SET @p1='Srpska napredna stranka'; -- naziv
SET @p2=''; -- datumosnivanja
CALL crta_insert_stranka(@p0, @p1, @p2);

SET @p0='1'; -- id 
SET @p1='Demokratska stranka'; -- naziv
SET @p2=''; -- datumosnivanja
CALL crta_insert_stranka(@p0, @p1, @p2);

SET @p0='2'; -- id 
SET @p1='Socijalisticka partija Srbije'; -- naziv
SET @p2=''; -- datumosnivanja
CALL crta_insert_stranka(@p0, @p1, @p2);	

SET @p0='3'; -- id 
SET @p1='Jedinstvena Srbija'; -- naziv
SET @p2=''; -- datumosnivanja
CALL crta_insert_stranka(@p0, @p1, @p2);

SET @p0='4'; -- id 
SET @p1='Srpska radikalna stranka'; -- naziv
SET @p2=''; -- datumosnivanja
CALL crta_insert_stranka(@p0, @p1, @p2);	