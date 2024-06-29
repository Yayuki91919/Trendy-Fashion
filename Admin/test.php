<?php  $count=1;
                                            if(!empty($locations)){
                                            foreach($locations as $location){
                                                $location_id=$location['location_id'];
                                                $fees=$fee_controller->getFeeLInfoByLocationId($location_id);

                                                foreach($fees as $fee){
                                             ?>
                                        <tr>
                                            <td><?php echo $count++ ?></td>
                                            <td><?php echo $location['city'] ?></td>
                                            <td><?php echo $location['township'] ?></td>
                                            <?php
                                             if(!empty($fee['fee'])){ ?>
                                            <td class="text-green text-center font-weight-bold"><?php echo $fee['fee']; ?> </td>
                                            <?php }elseif(empty($fee['fee'])){ ?>
                                            <td class="text-danger text-center font-weight-bold">-</td>
                                            <?php } ?>
                                            <td><a href="delivery_setting.php?allEdit_id=<?php echo $location['location_id']?>" data-toggle="tooltip" data-placement="top" title="Edit Location"><i class="fa fa-pencil color-muted m-r-5"></i> </a>
                                                <a href="delivery_setting.php?delete_id=<?php echo $location['location_id']?>" class="ti-trash" 
                                                data-toggle="tooltip" data-placement="top" title="Delete Location">
                                            </td>
                                        </tr>
                                         <?php }}} ?>