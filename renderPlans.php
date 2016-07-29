<?php 
if(isset($nonGroupPlans)){ ?>
   
<?php }else{
    $currIndex = 0;
}?>
<div class="head-plan">
		   <h1><b>Plans</b></h1>
		   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod</p>
		  </div>
<div class='cb-available-list cb-has-select'>
	<div class="plan_box1 price-box">		
			<div class="plan_boxhead">     
			<h3> Price </h3>              
			</div>						
			<ul class="list-unstyled price-data">     
			<li> Requests Per Second	 </li>             
			<li> Database Size</li>                  
			<li> Data Hosting</li> 
			<li> Data Transfer</li>
			<li> Backand Compute Units</li> 
			<li> Cache Memory</li>         
			<li> Environments</li> 
			<li> Dev Team Size </li>
			<li> Analytics history days	 </li>
			<li> Support </li>		
			</ul>								
			</div>
			
    <?php
    foreach ($planList as $key => $value) {
        $plan = $allPlansIndexed[$key];
        if ($plan->periodUnit == "week") {
            $planHeader = ($value == 1) ? "Weekly Plans" : $value . " Weekly Plan(s)";
        } elseif ($plan->periodUnit == "month" && $plan->period == 3) {
            $planHeader = "Quarterly Plans";
        } elseif ($plan->periodUnit == "month" && $plan->period == 6) {
            $planHeader = "Half Yearly Plans ";
        } elseif ($plan->periodUnit == "month") {
            $planHeader = ($value == 1) ? "Monthly Plans" : $value . " Monthly Plan(s)";
        } elseif ($plan->periodUnit == "year") {
            $planHeader = ($value == 1) ? "Yearly Plans" : $value . " Yearly Plan(s)";
        }

        if (isset($currIndex) && $currIndex != $value) {
            $currIndex = $value;
			?>
            <h4> <?php echo $planHeader ?></h4>
            <?php
        }
		
        if (($plan->status == "active") || ($plan->status == "archived")){ ?>
		
			<?php if($plan->id !="unlimited-offline-payment"): ?>
			<div class="current-plan"></div>				
            <div class='cb-available-item cb-avail-has-qty' data-cb="cb-available-item">
                <div class='radio'>
                    <label>
                        <input type='hidden' name='plan_id'  id='plan.id.<?php echo esc($plan->id) ?>' 
                            data-plan-id="<?php echo esc($plan->id) ?>" value="<?php echo esc($plan->id) ?>" validate="true" 
                            <?php echo ($curPlan == $plan->id ) ? "checked" : "" ?> 
                            <?php echo(!$havePaymentMethod) ? "disabled" : "" ?>
                        ><?php echo esc(isset($plan->invoiceName) ? $plan->invoiceName : $plan->name) ?>                          
                    </label>

                    <div class="cb-available-pick">
                        <?php if ($settingconfigData["changesubscription"]["planqty"] == 'true' && $settingconfigData["changesubscription"]["allow"] == 'true' && $plan->chargeModel == 'per_unit') { ?>
                            <span>Qty</span>
                            <input type="number" validate="true" class="form-control"  
                                data-plan-quantity="<?php echo esc($plan->id) ?>"
                                name="plan_quantity" data-cb="product-quantity-elem" min="1" 
                                value="<?php echo ($planId == $plan->id) ? $planQuantity : 1; ?>" 
                                onchange="planQuantityChange('<?php echo esc($plan->id) ?>')" 
                                <?php echo ($planId != $plan->id ) ? "disabled" : "" ?> >
                        <?php } ?>

                        <input type="hidden" id="plan_price_<?php echo esc($plan->id) ?>" data-plan-price="<?php echo esc($plan->id) ?>"
								name="plan_price" value="<?php echo number_format($plan->price / 100, 2, '.', '') ?>"/>
                        <?php $planqty = ($planId == $plan->id) ? $planQuantity : 1; 
                        	if (number_format($plan->price / 100, 2, '.', '') != 0.00) {
                         ?>
                            <strong id="product_price_<?php echo esc($plan->id) ?>" 
									class="cb-available-pick-price">
									<?php echo $configData['currency_value'] ?>
								<span data-plan-total-price="<?php echo esc($plan->id)?>">
									<?php echo number_format($plan->price * $planqty / 100, 2, '.', '')."/mo" ?>
								</span>			
							</strong>
                        <?php } ?>
                        <?php if (number_format($plan->price / 100, 2, '.', '') == 0.00) {
                            echo("FREE");
                        }
                         ?>
                        
                    </div>
                    <div class="clearfix"> </div>
                    <?php if (isset($plan->description)) { ?>
                        <hr class="clearfix">
                        <p class="help-block"> <?php echo esc($plan->description) ?></p>
                    <?php } ?>
                </div>		
				<?php if($plan->name=='Prototype'){?>	
				<ul class="list-unstyled plan-border">    
				<li> 30	 </li>              
				<li> 2 GB</li>           
				<li> 10 GB</li>             
				<li> 100 GB</li>      
				<li> 1,500,000</li>                  
				<li> 65,000 KB/H</li>                 
				<li> 1</li>             
				<li> 1</li>             
				<li> 1	 </li>			
				<li>Standard</li>   
				                   
				<li style="background:#fff!important;">  <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button">select</button> </li>                                      </ul>			
				<?php }//if($plan->name=='Unlimited Offline Payment') {?>	
<!--ul class="list-unstyled plan-border">    
				<li> 30	 </li>                     
				<li> 3 GB</li>                
				<li> 100 GB</li>                
				<li> 150 GB</li>      
				<li> 3,000,000</li>                   
				<li> 14,000 KB/H</li>                  
				<li> 1</li>              
				<li> 1</li>           
				<li> 1</li>                
				<li>Standard</li>			
				                
				<li style="background:#fff!important;">  <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button">SELECT</button> </li>                                
				</ul-->						
				<?php //}
				if($plan->name=='Hobby'){?>	
				<ul class="list-unstyled plan-border"> 
				<li> 30	 </li>                     
				<li> 3 GB</li>                
				<li> 100 GB</li>                
				<li> 150 GB</li>      
				<li> 3,000,000</li>                   
				<li> 14,000 KB/H</li>                  
				<li> 1</li>              
				<li> 1</li>           
				<li> 1</li>                
				<li>Standard</li>			
				                        
				<li style="background:#fff!important;"> <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button"> select</button> </li>         
				</ul>						
				<?php }if($plan->name=='Work'){?>	
				<ul class="list-unstyled plan-border">    
				<li> 30	 </li>                    
				<li> 10 GB </li>                 
				<li> 300 GB </li>                
				<li> 450 GB</li>           
				<li> 6,000,000 </li>              
				
				<li> 500,000 KB/H</li>                
				<li> 1</li>              
				<li> 2</li>          
				<li> 30</li>                 
				<li> Standard</li>		
				            
				<li style="background:#fff!important;">  <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button"> select</button> </li>                                      </ul>							
				<?php }if($plan->name=='Production'){?>		
				<ul class="list-unstyled plan-border">    
				<li> 50	 </li>                     
				<li> 30 GB</li>                
				<li> 1 TB</li>                
				<li> 1 TB</li>      
				<li> 20,000,000</li>                   
				            
				<li> UNLIMITED</li>           
				<li> 2</li> 
				<li> 5</li> 				
						
				<li>365</li>  
				<li>Production</li>					
				<li style="background:#fff!important;">  <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button">SELECT</button> </li>                                
				</ul>							
				<?php }if($plan->name=='Scale'){?>			
				<ul class="list-unstyled plan-border">      
				<li> 80	 </li>                    
				<li> 100 GB</li>                     
				<li> 2 TB</li>                     
				<li> 1.5 TB</li>          
				<li> 200,000,000</li>                      
			     <li> UNLIMITED</li>               
				<li> 3</li>    
				<li> 10</li> 
				<li> UNLIMITED</li>            
				                
				<li> Production	 </li>		
				       
                <li style="background:#fff!important;">  <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button"> select</button> </li>                                      </ul>						
				<?php }if($plan->name=='Enterprise'){?>		
				<ul class="list-unstyled plan-border">    
				<li> 200</li>                     
				<li> 300 GB</li>                   
				<li> 5 TB</li>              
				<li> 2 TB</li>    
				
				<li>500,000,000</li>                
				<li>UNLIMITED</li>        
                <li>4</li>       
				<li>UNLIMITED</li>
				<li>UNLIMITED</li>  
                          
				<li>Acc. manager</li>	
				       
				<li style="background:#fff!important;"> <button onclick="location.href='/apps/#/sign_up?p=1a'" class="select_button">select </button> </li>                                      </ul>				
				<?php }?>
            </div>
            <?php endif;
        }		
    }
    ?>
</div>