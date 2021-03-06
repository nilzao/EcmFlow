#!/bin/bash
caminho="/docinput/"
dir_install="/paginas/ecmflow_git/"
while [ true ]; do
 totalbmp=$(find $caminho -iname "*.bmp" | grep -m 1 -ic .bmp)
 if [ $totalbmp == 1 ]; then
    o=$(find $caminho -iname "*.bmp" -printf "\"%p\"\n" | grep -m1 "");
    imagickargs="-quality 50 -format jpeg -geometry 1000x9000 $o jpg:${o/bmp/jpg}";
    du_args="-b $o";
    str_1="";
    str_2="x"
    while [ "$str_1" != "$str_2" ]; do
     str_1=$(echo $du_args|xargs du);
     sleep 1;
     str_2=$(echo $du_args|xargs du);
    done;
    
#para depurar:
#    echo convert $imagickargs;
#    echo rm -rf $o;
    echo $imagickargs | xargs convert;
    echo $o |xargs rm -rf;
 fi
 
 totaljpg=$(find $caminho -iname "*.jpg" | grep -m 1 -ic .jpg)
 if [ $totaljpg == 1 ]; then
    o=$(find $caminho -iname "*.jpg" -printf "\"%p\"\n" | grep -m1 "")
    imagickargs="-quality 50 -format jpeg -geometry 1000x9000 $o jpg:$o";
    du_args="-b $o";
    str_1="";
    str_2="x"
    while [ "$str_1" != "$str_2" ]; do
     str_1=$(echo $du_args|xargs du);
     sleep 1;
     str_2=$(echo $du_args|xargs du);
    done;
    echo $imagickargs| xargs convert;

    phpargs=$dir_install"index.php Shell newDoc 1 $o 1";
    id_doc=$(echo $phpargs | xargs php);
    
    phpargs=$dir_install"index.php Shell addPag $id_doc $o 1 ";
#para depurar:
#    echo $phpargs;
    echo $phpargs | xargs php;

    echo $o |xargs rm -rf;
 fi

 total=$(find $caminho -iname "*.pdf" | grep -m 1 -ic .pdf)
  if [ $total == 1 ]; then
    o=$(find $caminho -iname "*.pdf" -printf "\"%p\"\n" | grep -m1 "")
    imagickargs="-density 300x300 -format jpeg -geometry 1000x9000 -flatten -background white $o jpg:$caminho"tmp/docX.jpg"";

    du_args="-b $o";
    str_1="";
    str_2="x"
    while [ "$str_1" != "$str_2" ]; do
     str_1=$(echo $du_args|xargs du);
     sleep 1;
     str_2=$(echo $du_args|xargs du);
    done;
    
    echo $imagickargs| xargs convert;
    echo $o |xargs rm -rf;

    if [ -e $caminho"tmp/docX.jpg" ]; then
      mv $caminho"tmp/docX.jpg" $caminho"tmp/docX-0.jpg";
    fi
    totalpag=$(find $caminho"tmp/" -iname "*.jpg" | grep -ic .jpg);
    
    cd $dir_install

    phpargs=$dir_install"index.php Shell newDoc 1 $o $totalpag";
# depurar
#echo $phpargs    
    id_doc=$(echo $phpargs | xargs php);
     
    for opag in $(find $caminho"tmp/" -iname "*.jpg"); do
      phpargs=$dir_install"index.php Shell addPag $id_doc $opag ";
      echo $phpargs | xargs php;
      echo $opag | xargs rm -rf;
    done
  fi
 sleep 1
done
