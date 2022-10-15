<?php
//都道府県ごとにデータベースを作るためのページ
require('dbc.php');
error_reporting(E_ALL & ~E_NOTICE);
$dbc = new Dbc;
$dbh = $dbc->dbConnectRamenMap();

//コピーしたURLを張り付け，URLごとに分割する．
//indexの桁数により分ける．
//
$val1 = 'https://www.youtube.com/watch?v=RgqhAJMs7xo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=181https://www.youtube.com/watch?v=GOVE3PBglCw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=180https://www.youtube.com/watch?v=-AymrzJtIzo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=179https://www.youtube.com/watch?v=FkyeG67R848&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=178https://www.youtube.com/watch?v=nT_xNLKpsqg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=177https://www.youtube.com/watch?v=ktiGJ2ixv9A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=176https://www.youtube.com/watch?v=6ksp8Fuqd6A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=175https://www.youtube.com/watch?v=f-3nx-olyU8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=174https://www.youtube.com/watch?v=WnXJumvSvlg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=173https://www.youtube.com/watch?v=yorexBNJAYA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=172https://www.youtube.com/watch?v=nAWpp2_YnEA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=171https://www.youtube.com/watch?v=8E5HOBRcPOM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=170https://www.youtube.com/watch?v=HsUS7o9Twfc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=169https://www.youtube.com/watch?v=D5FRw5M_X_E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=168https://www.youtube.com/watch?v=ro3cj78RVlE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=167https://www.youtube.com/watch?v=fjXTmmX8DAE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=112https://www.youtube.com/watch?v=KG_2Gw1Ut4c&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=111https://www.youtube.com/watch?v=UF5uOvUUxqM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=110https://www.youtube.com/watch?v=bxyZu3TNWIE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=109https://www.youtube.com/watch?v=ijPAL1XbRLU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=108https://www.youtube.com/watch?v=wFDEHFD__6A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=107https://www.youtube.com/watch?v=4Qsb-FsYCSw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=106https://www.youtube.com/watch?v=8eOlOxBS_r8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=105https://www.youtube.com/watch?v=Mgo3zI52-EA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=104https://www.youtube.com/watch?v=ge7ARy7Amo4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=103https://www.youtube.com/watch?v=6O0bOtERkP8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=102https://www.youtube.com/watch?v=N_uy-SL6oO4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=101https://www.youtube.com/watch?v=MazrtQoU80I&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=100';

$val2 = 'https://www.youtube.com/watch?v=5Zg6TzcdVSI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=99https://www.youtube.com/watch?v=yw90qmFrkKk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=98https://www.youtube.com/watch?v=2pEu0YDDKTQ&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=97https://www.youtube.com/watch?v=8Wd45UQEiAc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=96https://www.youtube.com/watch?v=JuZaaYgEohA&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=95https://www.youtube.com/watch?v=f-Sx7kaaVWQ&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=94https://www.youtube.com/watch?v=OdlIRT_ETuQ&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=93https://www.youtube.com/watch?v=fAS69VaFNcs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=92https://www.youtube.com/watch?v=rCKx47Pz060&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=91https://www.youtube.com/watch?v=NoyJBZ_wM5w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=90https://www.youtube.com/watch?v=HbVC5K11Ukw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=89https://www.youtube.com/watch?v=fB9UwGpGmDo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=88https://www.youtube.com/watch?v=GjakMcgGeWM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=87https://www.youtube.com/watch?v=3EG1d0BWUU0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=86https://www.youtube.com/watch?v=ytiEZxZMPiI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=85https://www.youtube.com/watch?v=N4JlUUv2I8Q&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=84https://www.youtube.com/watch?v=WNXJT8LzCfg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=83https://www.youtube.com/watch?v=oXZrSu0zNPg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=82https://www.youtube.com/watch?v=VZAPBn1A0Qs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=81https://www.youtube.com/watch?v=uDMWFbC7wNQ&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=80https://www.youtube.com/watch?v=2HpX4bW3ops&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=79https://www.youtube.com/watch?v=eL671tQIZ_w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=78https://www.youtube.com/watch?v=zCfrWlKruB8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=77https://www.youtube.com/watch?v=qC_HJzJUzws&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=76https://www.youtube.com/watch?v=IB6mx1j_XZM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=75https://www.youtube.com/watch?v=LdC8yj_EVww&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=74https://www.youtube.com/watch?v=MHJKY2kzuSs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=73https://www.youtube.com/watch?v=b0-URfiAHNI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=72https://www.youtube.com/watch?v=Tw0An18AVUY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=71https://www.youtube.com/watch?v=FdoDtY9SriQ&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=70https://www.youtube.com/watch?v=7FntzLVWkN8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=69https://www.youtube.com/watch?v=xM-bM9sKcAM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=68https://www.youtube.com/watch?v=80bbHHYe5fU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=67https://www.youtube.com/watch?v=TYZ2KnolUr4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=66https://www.youtube.com/watch?v=VYAr3DFCBWI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=65https://www.youtube.com/watch?v=1GFWDnQLQpY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=64https://www.youtube.com/watch?v=z-goLRCLOhE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=63https://www.youtube.com/watch?v=u8UReWLZ8aY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=62https://www.youtube.com/watch?v=T0d-lQizLMY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=61https://www.youtube.com/watch?v=ZPPC5LAsrdU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=60https://www.youtube.com/watch?v=NCvsDSuDu6A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=59https://www.youtube.com/watch?v=b4ed3-PYF8E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=58https://www.youtube.com/watch?v=C-y4XT34XiY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=57https://www.youtube.com/watch?v=0I5d9CvYjZs&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=56https://www.youtube.com/watch?v=mh2gP3dY04I&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=55https://www.youtube.com/watch?v=dIkwXOIkbyc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=54https://www.youtube.com/watch?v=mWwSL7zfbps&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=53https://www.youtube.com/watch?v=RdAc73hfSrI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=52https://www.youtube.com/watch?v=GQu8sbcal8E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=51https://www.youtube.com/watch?v=fv8qPa1_Jyw&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=50https://www.youtube.com/watch?v=YZA04_zeP1o&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=49https://www.youtube.com/watch?v=r31s7oguDT4&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=48https://www.youtube.com/watch?v=5GP0pFnsIQ8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=47https://www.youtube.com/watch?v=ZJxYcm8rLp8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=46https://www.youtube.com/watch?v=rR-nEVUM-Gc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=45https://www.youtube.com/watch?v=mMCkkN3o_vM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=44https://www.youtube.com/watch?v=FLlmFzAUuOY&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=43https://www.youtube.com/watch?v=GHt9Gghwl6w&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=42https://www.youtube.com/watch?v=DL0ONRR7wS0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=41https://www.youtube.com/watch?v=UkhqgNrMe4E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=40https://www.youtube.com/watch?v=-gMFxWkd28c&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=39https://www.youtube.com/watch?v=NGmXRqQUO2s&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=38https://www.youtube.com/watch?v=c6UKNK3SmNc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=37https://www.youtube.com/watch?v=Kz7f52J4aJM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=36https://www.youtube.com/watch?v=Hl_1IkO5tyo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=35https://www.youtube.com/watch?v=WYFCPiJhr4k&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=34https://www.youtube.com/watch?v=jcIb_cZCf68&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=33https://www.youtube.com/watch?v=OSPyUPkC9WE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=32https://www.youtube.com/watch?v=-bmQuj2p424&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=31https://www.youtube.com/watch?v=A6lIPYyyVBc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=30https://www.youtube.com/watch?v=PhaAwGcJew0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=29https://www.youtube.com/watch?v=gSEm55LJPMU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=28https://www.youtube.com/watch?v=2IM5Foz6K04&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=27https://www.youtube.com/watch?v=UV40kcPATgE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=26https://www.youtube.com/watch?v=Ich5Kte1Bb0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=25https://www.youtube.com/watch?v=ichqsDdHKQI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=24https://www.youtube.com/watch?v=kYTgwKV4K_E&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=23https://www.youtube.com/watch?v=bZCfZ6HoXio&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=22https://www.youtube.com/watch?v=4Yu-94bhdDM&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=21https://www.youtube.com/watch?v=FG_A0K3Eqpc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=20https://www.youtube.com/watch?v=u6f_EhNxQfc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=19https://www.youtube.com/watch?v=H904qwg0r6A&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=18https://www.youtube.com/watch?v=-sX6UNTljhg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=17https://www.youtube.com/watch?v=3NTj4Drql58&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=16https://www.youtube.com/watch?v=FBSNUg_xlX0&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=15https://www.youtube.com/watch?v=hQutZTR9EXI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=14https://www.youtube.com/watch?v=f9i2Z5CRzFU&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=13https://www.youtube.com/watch?v=NyZXG-cz3lc&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=12https://www.youtube.com/watch?v=cVWxy9DpGTk&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=11https://www.youtube.com/watch?v=jbwM80czi0k&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=10';

$val3 = 'https://www.youtube.com/watch?v=NUWLwl8g2xo&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=9https://www.youtube.com/watch?v=HqFDEmQkFE8&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=8https://www.youtube.com/watch?v=47VHwA_KaXE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=7https://www.youtube.com/watch?v=ioyynu2DOuI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=6https://www.youtube.com/watch?v=k6Sb1ZUnQcE&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=5https://www.youtube.com/watch?v=a0DfI20DHzg&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=4https://www.youtube.com/watch?v=KH2Q25Gt8Do&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=3https://www.youtube.com/watch?v=LzCdJTSMMkI&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=2https://www.youtube.com/watch?v=obk0bBGz228&list=PLRiGv_zZZiw_4BTGeUKApySKFHL8Vo8Fk&index=1';

//１桁　91
$val_array = str_split($val3, 91);

//print_r ($val_array);


//youtube_urlを準備
/*
$youtube_url = 'https://www.youtube.com/watch?v=Kt2t1r7ArDs&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=1https://www.youtube.com/watch?v=HhWLg6zN-0w&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=2https://www.youtube.com/watch?v=fFAGpnCPqdU&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=3https://www.youtube.com/watch?v=fhBuapZEBYY&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=4https://www.youtube.com/watch?v=sGfFFKTZOks&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=5https://www.youtube.com/watch?v=KpUYoUHgvt4&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=6https://www.youtube.com/watch?v=f2zMJ8PbQ6Q&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=7https://www.youtube.com/watch?v=1qgsTlHxqGI&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=8https://www.youtube.com/watch?v=kJ74qJqf6MI&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=9';
$youtube_url2 = 'https://www.youtube.com/watch?v=jT7FmI2cDZQ&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=10https://www.youtube.com/watch?v=G0NWC4g8Kbg&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=11https://www.youtube.com/watch?v=aYmYfuovIpc&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=12https://www.youtube.com/watch?v=N1eF5VRssW0&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=13https://www.youtube.com/watch?v=iawIA492kSc&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=14https://www.youtube.com/watch?v=BfrzVzQJMmk&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=15https://www.youtube.com/watch?v=J13RmIYIciI&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=16https://www.youtube.com/watch?v=o_9ohCwTkxU&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=17https://www.youtube.com/watch?v=Jm334inmJmY&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=18https://www.youtube.com/watch?v=390cMKshLG8&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=19https://www.youtube.com/watch?v=EBZlqNVNtkQ&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=20https://www.youtube.com/watch?v=4wS5UgYqzyQ&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=21https://www.youtube.com/watch?v=r7--nuM8mf8&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=22https://www.youtube.com/watch?v=VLrF7HONcsg&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=23https://www.youtube.com/watch?v=EnKcPlEv9TU&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=24';
*/
//$youtube_url ⇒ $youtube_url_array に分割
//１桁　91

//$youtube_url_array ⇒ $stack (video_idの配列)

$stack = [];
for ($j=0; $j <= 8; $j++) {
  $yt_url = $val_array[$j];
  $yt_url2 = strstr($yt_url, 'watch?v=');
  $yt_url3 = strstr($yt_url2, '&list=', true);
  $yt_url4 = str_replace('watch?v=', '', $yt_url3);
  array_push($stack, $yt_url4);
}
//video_idを表示
//print_r($stack);



// $stackに配列として入っているvideo_idから、店名の配列を作成
$count = 0;
foreach ($stack as $video_id) {
  $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=AIzaSyDowI75TIuk3j4UAkp2kGeKUlqyH3X1tuw&part=snippet,contentDetails,statistics,status";
  $json = file_get_contents($get_api_url);
  $getData = json_decode( $json , true);

  foreach((array)$getData['items'] as $key => $gDat){
  	$description = $gDat['snippet']['description'];

    $result = strstr($description, '【本日の');
    $result2 = str_replace('食べログＵＲＬ', '', $result);
    $result3 = strstr($result2, 'http://tabelog', true);
    $result31 = strstr($result2, 'https://tabelog', true);

    $replace4 = str_replace('【本日のお店情報】', "'),('", $result3);
    $replace5 = str_replace('【本日のラーメン情報】', "'),('", $replace4);
    $replace6 = str_replace('【本日のお店】', "'),('", $replace5);
    $replace41 = str_replace('【本日のお店情報】', "'),('", $result31);
    $replace51 = str_replace('【本日のラーメン情報】', "'),('", $replace41);
    $replace61 = str_replace('【本日のお店】', "'),('", $replace51);

    echo $replace6;
    echo $replace61;
    $count +=1;
}
}




//PDOでデータベース操作 INSERT UPDATE

//住所2－9
$ad_1 = [(' とろ肉つけ麺魚とん 東京都千代田区神田小川町1-7 神田小川町ハイツ １Ｆ '),(' 元祖スタミナ満点らーめんすず鬼 東京都三鷹市下連雀3-28-21 公団三鷹駅前第2アパート B1F '),(' 京都銀閣寺ますたに日本橋本店 東京都中央区日本橋2-10-3 エグゼトゥール日本橋 1F '),(' かいらく 東京都北区王子2-28-9 '),(' 志奈そば田なか 明神下店 東京都千代田区外神田3-4-1 '),(' 麺家ばく 東京都中野区東中野4-4-3 山内ビル 1F '),(' らぁ麺や嶋 東京都渋谷区本町3-41-12 '),(' 博多長浜ラーメン健太 東京都中野区大和町1-66-6 '),(' 中華そば 竹千代 東京都北区昭和町1-3-6 '),(' 麺処しろくろ 東京都杉並区上高井戸1-1-7 '),('らあめん花月嵐'),(' つけめん さなだ 東京都足立区千住3-6 '),(' YAKITORI燃 東京都港区六本木3-8-12 ＴＳビル 1F '),(' 麺屋 鳳 東京都足立区栗原1-6-22 '),(' 手打 親鶏中華そば綾川 東京都渋谷区恵比寿1-21-18 ライツ恵比寿1F '),(' はちどり 東京都板橋区板橋3-14-2 '),(' ただいま、変身中。 東京都中野区中野5-53-3 松本ビル 101 '),(' はな火屋 東京都新宿区西新宿7-15-17 井西ビル 1F '),(' 板橋大勝軒なりたや 東京都板橋区板橋2-60-1 '),(' Ramen FeeL 東京都青梅市梅郷4-695-1 '),(' 西安麺荘 秦唐記 新川本店 東京都中央区新川1-13-6 中央精器ビル 1F '),(' 眞久中 東京都千代田区神田小川町3-22 小川町細野ビル 1F '),(' りんりん 東京都足立区千住中居町17-14 '),(' 空ノ色 東京都北区堀船1-4-9 '),(' らーめん藪づか 東京都台東区上野3-13-1 西武ビル1階 '),(' 新京 東京都練馬区旭丘1-5-6 '),(' タンタン 東京都八王子市子安町1-30-6 '),(' ほっこり中華そば もつけ 東京都八王子市万町34-1')];
$lat_chiba = [36.4973905,139.0034216,36.3424154,139.006894,36.2581054,139.5518038,36.3499833,139.0068539,36.3474881,138.9562849,36.3309036,139.0038511,36.3366801,138.9653222,36.3245551,139.0089533,36.3479986,139.0117988,36.4102919,139.3392375,36.4231779,139.3495635];
//住所11-50
$ad_2 = [(' 末廣ラーメン本舗 高田馬場分店 東京都新宿区高田馬場2-8-3 '),(' 中華そば しながわ 東京都豊島区西池袋4-19-14 '),(' つけそば屋 麺楽 東京都青梅市野上町2-3-8 '),(' ら～めん　からしや 葛西本店 東京都江戸川区中葛西3-26-6 セントラルコーポ 1F '),('蒙古タンメン中本 町田店
東京都町田市中町1-1-3'),(' 老郷 本店 神奈川県平塚市紅谷町17-23 '),(' のスた 東京都品川区東大井6-1-1 '),(' ヨコハマ 中華そば かみ山 東京都世田谷区経堂5-29-21 '),(' 麺屋 愛心 町屋店 東京都荒川区荒川7-39-3 シティハイム町屋 1F '),(' ハナイロモ麺 東京都武蔵野市吉祥寺本町1-31-4 日得ビル'),(' 炭火焼濃厚中華そば 海富道 東京都千代田区神田鍛冶町3-3-2 床屋3ビル1F '),(' 武蔵野アブラ学会 代々木店 東京都渋谷区代々木1-58-7 ヴェラハイツ代々木 1F '),(' つけ麺麦の香 東京都新宿区西早稲田2-11-13 第一山武ビル 1F '),(' らーめん弁慶 門前仲町店 東京都江東区深川1-1-8 '),(' 吉祥寺武蔵家 両国店 東京都墨田区亀沢1-1-9 '),(' ラーメン 前原軒 東京都小金井市前原町1-7-5 '),('らあめん花月嵐 荻窪西口店
東京都杉並区上荻1-10-7'),(' 麺屋 ふぅふぅ亭 東京都新宿区矢来町118 石本マンション1F '),(' 洞くつ家 東京都武蔵野市吉祥寺南町2-2-4 '),(' お茶の水、大勝軒 BRANCHING 東京都千代田区神田神保町3-10 '),(' せんだが家 まぜそば 東京都渋谷区千駄ヶ谷3-30-4 '),(' 麺処 いし川 東京都あきる野市二宮337-1 '),(' MENクライ 東京都港区芝1-3-4 山谷ビル 1F '),(' つじ田 秋葉原店 東京都千代田区外神田1-9-5 第1ナガシマビル 1F '),(' ラーメン 健やか 東京都武蔵野市中町1-28-1 矢島ビル 102 '),(' らーめん バリ男 大森店 東京都品川区南大井6-24-1 '),(' 中華そば たた味 東京都中央区日本橋小伝馬町15-20 '),(' 中華そば丸信 東京都杉並区上荻1-24-22 '),(' ホープ軒 東京都渋谷区千駄ヶ谷2-33-9 '),(' かつぎや 東京都千代田区神田小川町3-11-2 インペリアルお茶の水103 '),(' えどもんど 東京都荒川区西日暮里5-31-9 '),('らあめん花月嵐 西新宿6丁目店
東京都新宿区西新宿6-26-8'),(' ことぶき 東京都西東京市ひばりヶ丘北3-3-33 1F '),(' 壱発ラーメン 福生店 東京都福生市加美平1丁目18-19 '),('蒙古タンメン中本 秋津店 東京都東村山市秋津町5-7-8 　秋津駅南口店舗 １階'),(' カッパ64 東京都福生市北田園1-6-9 '),(' 中華蕎麦 ひら井 東京都府中市栄町2-11-7 '),(' SOBA HOUSE 金色不如帰 新宿御苑本店 東京都新宿区新宿2-4-1 第22宮廷マンション'),('一蘭 新橋店 東京都港区新橋2-5-6 2F'),(' 亀戸煮干中華蕎麦つきひ 東京都江東区亀戸5-13-2 スクエア三報104区画'),(' つけ麺屋 やすべえ 高田馬場店 東京都新宿区高田馬場1-22-7 １Ｆ '),(' 皇綱家 東京都豊島区西池袋1-18-1 五光ビル 1F '),('夢を語れ東京赤坂店(人類みな麺類Redの店舗内にて営業) 東京都港区赤坂3-13-14'),(' 横浜家系ラーメン侍 渋谷本店 東京都渋谷区道玄坂2-6-6 '),(' もみじ屋 東京都杉並区和泉2-9-21 '),(' 東京油組総本店　池袋組 東京都豊島区西池袋1-23-1 1F '),(' 支那そばや 東京ラーメンストリート店 東京都千代田区丸の内1-9-1 東京駅一番街 東京ラーメンストリート'),(' ラーメン三浦家 東京都葛飾区金町6-5-1 ベルトール金町 1F '),(' スープメン （Soupmen） 東京都板橋区南常盤台1-26-9 常盤台ダイカンプラザシティ 1F '),(' なるめん 東京都大田区北千束3-16-10 '),(' 自家製麺 No11 東京都板橋区大山金井町14-12 '),(' 寿製麺よしかわ 西台駅前店 東京都板橋区蓮根3-8-14 '),(' 和歌山ラーメン まる岡 東京都葛飾区亀有5-20-13 '),(' 味噌らーめん 柿田川ひばり 恵比寿本店 東京都渋谷区恵比寿西1-10-8 杉山ビル 1F '),(' らぁ麺や 嶋 東京都渋谷区本町3-41-12 '),(' 駄目な隣人 東京都中央区日本橋人形町3–7-13 日本橋センチュリープラザ 1F '),('蒙古タンメン中本 御徒町店 東京都台東区上野5-10-14 第二御徒町橋高架下'),(' 焼きあご塩らー麺 たかはし 歌舞伎町店 東京都新宿区歌舞伎町1-19-3 歌舞伎町商店街振興組合ビル '),(' のんきや 東京都西多摩郡奥多摩町原368-4 '),(' 辛麺サソリ 東京都板橋区上板橋3-5-1 上坂ビル 1F '),(' ラーメンノックアウト 東京都足立区南花畑5-22-6 '),(' ゼクト 東京都千代田区神田小川町1-7 神田小川町ハイツ '),(' 中華そば 一清 東京都小金井市前原町3-40-23 '),(' 炭火焼濃厚中華そば 倫道 東京都港区新橋1-14-8 有信ビル 1F '),(' 魂の中華そば 東京都板橋区上板橋1-25-10 '),(' 背脂煮干中華そば 和市 東京都港区新橋3-14-6 駒場ビル 1F '),('らあめん花月嵐'),(' 新潟ラーチャン専門 我武者羅 四谷店 東京都新宿区四谷1-18-5 Belle四谷 1F '),(' らーめん弁慶 浅草本店 東京都台東区花川戸2-17-9 '),(' 王道家直系 IEKEI TOKYO 東京都千代田区外神田5-2-7 外神田下村ビル 1F '),(' 麺 酒 やまの 東京都練馬区豊玉北5-23-11 豊玉ビル B1F '),(' ラーメンショップ 新奥多摩街道店 東京都羽村市小作台5-16-9 '),(' 中華そば うお青 東京都日野市石田2-9-1 アイビル 1F '),(' ラーメン玉・赤備 アクアシティお台場店 東京都港区台場1-7-1 アクアシティお台場 5F ラーメン国技館舞'),(' おうじ家 東京都北区王子1-10-16 王子駅前ビル 1F '),(' ラーショ マルミャー 東京都豊島区池袋2-22-5 東仙第2ビル 1F '),(' マルナカ 東京都新宿区新小川町8-4 '),(' 元祖一条流 がんこラーメン 立川たま館分店 東京都立川市錦町1-2-16 立川アーバンホテル 立川らーめんたま館 '),(' 博多ラーメン でぶちゃん 高田馬場本店 東京都新宿区高田馬場2-13-6 '),(' ツルメン トウキョウ 東京都江東区亀戸3-45-18 亀戸三丁目ビル 1F '),(' えどもんど 東京都荒川区西日暮里5-31-9 '),(' 横浜家系ラーメン侍 渋谷本店 東京都渋谷区道玄坂2-6-6 '),(' 麺や 維新 東京都品川区上大崎3-4-1 サンリオンビル １Ｆ'),(' ザ・ラーメンスモールアックス 東京都品川区東大井5-3-5 '),(' らぁめん大安 東京都八王子市子安町1-11-10 エリートビル　１Ｆ'),(' 麺や 麦ゑ紋 東京都新宿区西新宿7-4-6 ストーク新宿井岡 1F '),(' 平和軒 東京都品川区大崎3-1-16 '),(' じもん 東京都杉並区高円寺南4-7-13 仲野ビル 1F '),(' 麺笑 巧真 東京都八王子市明神町4-12-2 '),(' 武蔵家 中野本店 東京都中野区中央4-4-1 ')];
$ad_3 = [(' 超絶濃厚鶏そば きりすて御麺 東京都品川区小山台1-33-11 アネックスかむろ坂 1F '),(' 駄目な隣人 新宿店 東京都新宿区歌舞伎町1-27-2 1F '),('らあめん花月嵐 荻窪西口店 東京都杉並区上荻1-10-7'),(' ラーメン富士丸 神谷本店 東京都北区神谷3-29-11 '),(' ワンタンメンの満月 三鷹店 東京都三鷹市下連雀4-16-15 東洋三鷹コーポ 1F '),(' 元祖スタミナ満点らーめん すず鬼 東京都三鷹市下連雀3-28-21 公団三鷹駅前第2アパート B1F '),(' ヌードルボウズ n坊 東京都台東区浅草橋1-33-5 むさしやビル 1F '),(' 麺や独歩 東京都昭島市中神町1157-55 '),(' Ramen FeeL 東京都青梅市梅郷4-695-1 9')];
//15
$lat_2 = [35.6939392,139.7654533,35.6997818,139.5612484,35.6810265,139.7749732,35.757138,139.7383339,35.7009948,139.7694236,35.706543,139.6841582,35.6883241,139.6808244,35.7090463,139.6515485,35.7468635,139.755431,35.6697618,139.6155288,39.7170915,140.1379183,35.68183972056648, 139.77453609140275,35.6631893,139.7343407,35.7795981,139.7898904];
//14
$lat_2_1 = [35.7119027,139.708592,35.7303103,139.6988208,35.7921678,139.2868229,35.6665679,139.8717272,35.5455195,139.445751,35.3279973,139.3461349,35.6048838,139.7349384,35.6478013,139.6356917,35.7417281,139.7810037,35.703993,139.5823855,35.6933421,139.770846,35.68256689912351, 139.77437903848713,35.7099062,139.7132186,35.674445,139.7958287];
$lat_3 = [35.6959832,139.7988346,35.6890299,139.5107628,35.704754,139.6177326,35.7040584,139.734018,35.7021384,139.580696,35.697133,139.7544992,35.6773474,139.7075901,35.7310781,139.2929917,35.6524822,139.7550299,35.699029,139.7701344,35.7037564,139.5643139,35.68184837726615, 139.77555849290343,35.6915949,139.779624];
//12
$lat_4 = [35.707132,139.61625,35.6765896,139.7124517,35.6940824,139.7625672,35.7337264,139.7683329,35.6954041,139.6884234,35.7518992,139.5460322,35.7498644,139.3269278,35.7783395,139.4961895,35.7328539,139.3255436,35.6880356,139.4796055,35.6887843,139.7082917,35.6674769,139.755846,35.681648786713, 139.77526362929936,35.7106049,139.7044402];
//11
$lat_5 = [35.7312474,139.7093166,35.6735029,139.737142,35.6587753,139.6991044,35.6716932,139.651447,35.7317583,139.7101334,35.6802935,139.7679568,35.7687765,139.8714119,35.7581546,139.6902317,35.6066287,139.6871691,35.7449509,139.7079876,35.7859088,139.6747265,35.68168870486357, 139.7750670535633,35.6465397,139.7076616];

//15
$lat_6 = [35.6883241,139.6808244,35.6862729,139.7818126,35.7059298,139.7743831,35.6958215,139.701905,35.7828694,139.0358055,35.7653286,139.6759636,35.7983801,139.8129928,35.6940396,139.7657754,35.6984251,139.5061078,35.6682815,139.7572852,35.762765,139.6755902,35.68156895035194, 139.77521448536535,39.7170915,140.1379183];
//15
$lat_7 = [35.6862149,139.7275415,35.7151857,139.8007913,35.7043645,139.7723619,35.7359136,139.6542119,35.774081,139.301333,35.6696086,139.4191315,35.6282887,139.77409,35.7544918,139.7370016,35.7327926,139.704958,35.7056867,139.7409382];
//15
$lat_8 = [35.697108,139.416249,35.7124818,139.7073864,35.701734,139.8218088,35.7337264,139.7683329,35.6587753,139.6991044,35.6341915,139.7187601,35.6074869,139.7359291,35.6544608,139.3398862,35.6961146,139.6983768,35.6209075,139.7243094,35.7034307,139.6492444,35.6597904,139.3418593];
$lat_9 = [35.6919819,139.7207531,35.6952092,139.7005267,35.704754,139.6177326,35.7722931,139.7331108,35.695664,139.5610592,35.6997818,139.5612484,35.6986843,139.7849388,35.7119788,139.3768776,35.788712,139.2217761];
//住所51-98
$ad_kanagawa3 = [(' 柳麺 呉田 埼玉県さいたま市浦和区常盤9-16-7 '),(' NOODLE BASE TRICK☆STAR 埼玉県桶川市下日出谷928-12 '),(' 鷹の眼 埼玉県草加市栄町2-9-12  '),(' アキラ 埼玉県川越市仲町2-2 '),(' 狼煙 埼玉県さいたま市北区東大成町1-544 '),(' ラーメン店 どでん 埼玉県さいたま市緑区三室1207-4 '),(' オランダ亭 埼玉県春日部市緑町3-4-59 '),(' 替玉千里眼 志木店 埼玉県志木市本町5-25-6 NK志木ビル 1F '),(' 麺屋時茂 埼玉県草加市高砂2-5-5 '),(' 麺処いぐさ 埼玉県北足立郡伊奈町栄3-143-3 '),(' 麺屋 葵 埼玉県幸手市東4-1-24 '),(' 麺屋 桐龍 埼玉県川口市戸塚3-36-18 '),(' めんや 正明 埼玉県志木市本町5-23-28 本町カトレア 1F '),(' 楓神 埼玉県北足立郡伊奈町栄1-93 '),(' 中華そば輝羅 埼玉県久喜市菖蒲町下栢間2032-2 '),(' デカ盛り戦隊　豚レンジャー 埼玉県和光市本町21-26 コンステラション 1F '),(' メガガンジャ 埼玉県川越市脇田町5-5 '),(' 豚ラーメン 埼玉県蕨市中央1-33-8 '),(' びんびん豚 埼玉県富士見市鶴瀬東1-2-33 '),(' 寿製麺 よしかわ 川越店 埼玉県川越市今福1738-14 '),(' 煮干乱舞 埼玉県北葛飾郡杉戸町大字才羽823-2 道の駅　アグリパークゆめすぎと '),(' 鷹の眼 埼玉県草加市栄町2-9-12 '),(' ８８２３製麺 埼玉県草加市旭町4-10-13 '),(' ジャンプ 埼玉県春日部市南5-1-56 '),(' NOODLE STOCK 鶴おか 埼玉県草加市栄町3-3-21 '),(' 頑者 埼玉県川越市新富町1-1-8 '),(' 麺家うえだ 埼玉県新座市東北2-12-7 '),(' いぐさ 埼玉県北足立郡伊奈町栄3-143-3 '),(' 蒙麺 火の豚 埼玉県久喜市栗原3-2-1 '),(' メロディ 大宮店 埼玉県さいたま市大宮区仲町2-56 '),(' らーめん カッパハウス 埼玉県所沢市旭町2-1 '),(' らーめん五葉 川越店 埼玉県川越市脇田町27-10 アカシアビル 1F'),('らーめん五葉 川越店 埼玉県川越市脇田町27-10 アカシアビル 1F')];
//12
$lat_chiba9 = [35.8707357,139.6471532,35.998784,139.5529761,35.8435622,139.8020453,35.9211959,139.4832044,35.924004,139.622154,35.8800546,139.6726136,35.9731681,139.7673507,35.8237682,139.5754882,35.8267097,139.8035278,35.9775884,139.64054,36.0770827,139.7245017];
//11
$lat_chiba10 = [35.8244419,139.576145,35.9729219,139.6363379,36.0378649,139.5795088,35.7846415,139.607402,35.9096856,139.4821081,35.8290418,139.688459,35.8118855,139.6663176,35.8760346,139.4744544,36.0249488,139.7689747,35.8435622,139.8020453,35.8525894,139.7959523];
//10
$lat_chiba11 = [35.9699519,139.759689,35.8455738,139.8017185,35.9150498,139.482566,35.817609,139.5728393,35.9775397,139.6405525,36.0744471,139.706615,35.9049984,139.6275345,35.789451,139.4738885];
$lat_chiba12 = [35.6942044,140.0232011,35.5016649,140.11254,35.8603663,139.9689052,35.9318933,139.5836898,35.8629897,139.967405,35.7888013,139.9289631,35.7299295,139.9073586,35.8644441,140.0260419,35.785838,139.901765,35.7220378,139.9265852,35.7818,139.9009632];

print_r(count($lat_8));

//住所100-108
$ad_kanagawa4 = [(' ファットン 神奈川県横浜市神奈川区六角橋2-10-1 '),(' 蒙古タンメン中本 川崎店 神奈川県川崎市川崎区砂子2-5-7 '),(' 鎌倉蕎麦 沙羅善 神奈川県鎌倉市山ノ内115-3 '),(' 雷家 神奈川県川崎市川崎区小川町8-14 '),(' 八家 神奈川県横浜市保土ケ谷区和田1-12-17 '),(' 本牧家 神奈川県横浜市港南区下永谷3-1-5 '),(' みずき 神奈川県横浜市中区長者町5-52 '),(' 麺庵ちとせ 神奈川県小田原市風祭77-1')];
$lat_aomori = [35.529715,139.700708,35.3312044,139.5524047,35.5264126,139.6955148,35.4651614,139.5885989,35.4080267,139.5650211,35.4408182,139.6315715,35.2444044,139.1276052];
//配列の個数を調べる

//echo $lat_aomori2.$rrr;
//echo count($lat_aomori2);


//UPDATE用

/*
$update_first = 1071;
for ($i=0; $i<=8; $i++) {
  $key = $stack[$i];
  $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`video_id`='".$key."'WHERE id = '".$update_first."'");
  echo $update_first;
  echo "<br />";
  $update_first++;
}
*/
/*
$update_first = 1071;
for ($i=0; $i<=8; $i++) {
  $key = $ad_3[$i];
  $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`name_address`='".$key."'WHERE id = '".$update_first."'");
  echo $update_first;
  echo "<br />";
  $update_first++;
}
*/

/*
for ($i=1; $i<=1079; $i++) {
  //$key = $ad_aomori2[$i];
  $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET `status`= 0 WHERE id = '".$i."'");
  echo $i;
  echo "<br />";
}
*/

/*
$id_start = 1071;
$i = 0;
//&iには配列の２倍の数を入れる
while ($i < 18) {
  $key = $lat_9[$i];
  $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`latitude`='".$key."'WHERE id = '".$id_start."'");
  $i++;
  $key = $lat_9[$i];
  $stmt = $dbh->query("UPDATE `ramen_db_tokyo` SET`longitude`='".$key."'WHERE id = '".$id_start."'");
  echo $id_start;
  $id_start++;
  $i++;
}
*/


//INSERT用

/*
$url_kanagawa = ['https://www.youtube.com/watch?v=Kt2t1r7ArDs&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=1','https://www.youtube.com/watch?v=HhWLg6zN-0w&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=2','https://www.youtube.com/watch?v=fFAGpnCPqdU&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=3','https://www.youtube.com/watch?v=fhBuapZEBYY&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=4','https://www.youtube.com/watch?v=sGfFFKTZOks&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=5','https://www.youtube.com/watch?v=KpUYoUHgvt4&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=6','https://www.youtube.com/watch?v=f2zMJ8PbQ6Q&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=7','https://www.youtube.com/watch?v=1qgsTlHxqGI&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=8','https://www.youtube.com/watch?v=kJ74qJqf6MI&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=9','https://www.youtube.com/watch?v=jT7FmI2cDZQ&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=10','https://www.youtube.com/watch?v=G0NWC4g8Kbg&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=11','https://www.youtube.com/watch?v=aYmYfuovIpc&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=12','https://www.youtube.com/watch?v=N1eF5VRssW0&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=13','https://www.youtube.com/watch?v=iawIA492kSc&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=14','https://www.youtube.com/watch?v=BfrzVzQJMmk&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=15','https://www.youtube.com/watch?v=J13RmIYIciI&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=16','https://www.youtube.com/watch?v=o_9ohCwTkxU&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=17','https://www.youtube.com/watch?v=Jm334inmJmY&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=18','https://www.youtube.com/watch?v=390cMKshLG8&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=19','https://www.youtube.com/watch?v=EBZlqNVNtkQ&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=20','https://www.youtube.com/watch?v=4wS5UgYqzyQ&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=21','https://www.youtube.com/watch?v=r7--nuM8mf8&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=22','https://www.youtube.com/watch?v=VLrF7HONcsg&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=23','https://www.youtube.com/watch?v=EnKcPlEv9TU&list=PLRiGv_zZZiw8zJUU_5HNl9lTpowhexS-c&index=24'];
*/

//$url_kanagawa2 = [];
/*
$insert_id_first = 1071;
for ($i=0; $i<=8; $i++) {
  $url_content = $val_array[$i];
  $stmt = $dbh->query("INSERT INTO `ramen_db_tokyo` (id, youtube_url) VALUES ('$insert_id_first', '$url_content')");
  echo $insert_id_first;
  echo "</br>";
  $insert_id_first++;
}
/*



//DELETE用
/*
$insert_id_first = 20;
for ($i=0; $i<10; $i++) {
  $key = $url_aomori2[$i];
  $stmt = $dbh->query("DELETE FROM `ramen_db_tokyo` (id, name_address, youtube_url) VALUES ('$insert_id_first', '$key')");
  echo $insert_id_first;
  $insert_id_first++;
}
*/
 ?>
