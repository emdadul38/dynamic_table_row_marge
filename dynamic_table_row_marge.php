<div class="col-md-12" >
    <table  class="table" width="100%" cellspacing="0" id="aca_tbl">
        <thead>
	        <tr>
	            <th>Division</th>
	            <th>District</th>
	            <th>Branch</th>
	            <th>HLT</th>            
	            <th>Total</th>
	        </tr>
        </thead>

        <tbody>
            <?php $tHLT=0; $tTotal=0;  ?>
            <?php 
            # $arr is array which will be help ful during 
            # printing
            $arr = array(); 
            $div = array(); $dist = array(); $branch = array(); $HLT = array(); $Total = array();

            foreach ($dbAdmin as $key => $row) {
                array_push($div, $row->Division);
                array_push($dist, $row->District);
                array_push($branch, $row->Branch);
                array_push($HLT, $row->HLT);
                array_push($Total, $row->Total);

                if (!isset($arr[$row->District])) {
                    $arr[$row->District]['rowspan'] = 0;
                }
                $arr[$row->District]['printed'] = 'no';
                $arr[$row->District]['rowspan'] += 1;
            }
            $rowspan = 0;
            for ($i=0; $i < sizeof($branch) ; $i++) { 
                $District = $dist[$i];
                echo "<tr>";

                if($arr[$District]['printed'] == 'no'){
                    echo '<td rowspan = "'.($arr[$District]["rowspan"]+1).'">'. $div[$i] . '</td>';
                    echo '<td rowspan = "'.($arr[$District]["rowspan"]+1).'">'. $District . '</td>';
                    $arr[$District]['printed'] = 'yes';

                    $rowspan = $arr[$District]['rowspan'];
                }else{
                    $rowspan -= 1;
                }

                echo "<td>".$branch[$i] ."</td>";
                echo "<td>".$HLT[$i] ."</td>";
                echo "<td>".$Total[$i] ."</td>";
                echo "</tr>";

                $tHLT += $HLT[$i];
                
                $tTotal += $Total[$i];

                if($rowspan == 1){
                    echo "<tr>";
                    echo "<td style='color:#000;'><b>District Total</b></td>";
                    echo "<td style='color:#000;'><b>".$tHLT."</b></td>";
                    echo "<td style='color:#000;'><b>".$tTotal."</b></td>";
                    echo "</tr>";

                    $tHLT=0; $tTotal=0;
                }
            }
        ?>
        </tbody>
    </table>
</div>