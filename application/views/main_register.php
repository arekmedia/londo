<form method="post" name="regForm" style="padding-top:10px;" id="reg_input">
	<div style="float:left;" class="blue_title">
		<h2 class="top">Data Pemilik Akun</h2>
	</div>
	<div style="clear:both"></div>
	<div class="input">
		<div id="input_message"style="padding-top:10px;">
			<?php
				echo $message;
			?>
		</div>
	<span class="clear" style="padding-top:10px"></span>  
	<div style="float:left;width:200px;">Username</div><div><input type="text" name="username" onBlur="check_username_jq(this.form)" value="<?php echo $username; ?>"></div>	
	<span class="clear" style="padding-top:10px"></span>  
	<div style="float:left;width:200px;">Password</div><div><input type="password" name="password"></div>
	<span class="clear" style="padding-top:10px"></span>  
	<div style="float:left;width:200px;">Confirm Password</div><div><input type="password" name="vpassword"></div> 
	<span class="clear" style="padding-top:10px"></span>  
	<div style="float:left;width:200px;">Email</div><div><input type="text" name="email" onBlur="check_email_jq(this.form)" value="<?php echo $email; ?>" ></div> 
	<span class="clear" style="height:30px">&nbsp;</span> 
	<div style="float:left">
		<ul class="menu">  
			<li id="1" <?php echo selected("1",$b,"class='active'");?> >Pendaftaran Pelamar Kerja</li>  
			<li id="2" <?php echo selected("2",$b,"class='active'");?> >Pendaftaran Pemasang Iklan</li>  
		</ul>  
	</div>
	</div>
</fieldset>
<span class="clear"></span>  
<div class="content 1">  
	<span class="clear"></span>  
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Nama Pelamar</div><div><input type="text" name="sk_nama" value="<?php echo $sk_nama; ?>"> </div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Tgl Lahir</div><div><input type="text" name="sk_tgl_lahir" value="<?php echo $sk_tgl_lahir; ?>" id="datepicker"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Jenis Kelamin</div><div><input type="radio" name="sk_jns_klm" value="L" <?php echo selected("L",$sk_jns_klm,"checked");?>>Pria <input type="radio" name="sk_jns_klm" value="P"  <?php echo selected("P",$sk_jns_klm,"checked");?>> Wanita</div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Propinsi</div>
		<div>
			<select name="stateid_js" onchange="get_city_js(this.form)" >
			<?php 
				echo "<option value=''>--Pilih Propinsi--</option>";
				foreach($q_state->result() as $rows){
					echo "<option value='".$rows->state_id."' ".selected($rows->state_id,$stateid,"selected").">".$rows->state_value."</option>";
				}
			?></select>
		</div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Kota</div>
		<div id="city_js">
			<select>
			<?php 
				echo "<option value=''>--Pilih Kota--</option>";
			?>
			</select>
		</div> 	
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Alamat</div><div><input type="text" name="sk_alamat" value="<?php echo $sk_alamat; ?>"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">No. Telepon</div><div><input type="text" name="sk_no_tlp" value="<?php echo $sk_no_tlp; ?>"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">No. Handphone</div><div><input type="text" name="sk_no_hp" value="<?php echo $sk_no_hp; ?>"></div> 
	<span class="clear" style="height:50px">&nbsp;</span> 
	<div><input type="submit" name="register_js" value="daftar"><input type="hidden" readonly="readonly" name="type" value="js"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 

</div>  
<div class="content 2" >  
	<span class="clear"></span>  
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Nama Perusahaan</div><div><input type="text" name="comp_nama" value="<?php echo $comp_nama; ?>"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Alamat Perusahaan</div><div><input type="text" name="comp_alamat" value="<?php echo $comp_alamat; ?>"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Propinsi</div>
		<div>
			<select onclick="get_city_cm(this.form)" name="stateid_cm" >
			<?php 
				echo "<option value=''>--Pilih Propinsi--</option>";
				foreach($q_state->result() as $rows){
					echo "<option value='".$rows->state_id."' ".selected($rows->state_id,$stateid,"selected").">".$rows->state_value."</option>";
				
				}
			?></select>
		</div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Kota</div>
		<div id="city_cm">
			<select>
			<?php 
				echo "<option value=''>--Pilih Kota--</option>";
			?></select>
	</div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	<div style="float:left;width:200px;">Industri</div><div>
		<select name="comp_type_id">
		<?php 
			echo "<option value=''>--Pilih Industri--</option>";
			foreach($q_industri->result() as $rows){
				echo "<option value='".$rows->comp_type_id."'  ".selected($rows->comp_type_id,$comp_type_id,"selected").">".$rows->comp_type_value."</option>";
			
			}
		?></select>
	</div> 
	<span class="clear" style="height:50px">&nbsp;</span> 
	<div><input type="submit" name="register_cm" value="daftar"><input type="hidden" readonly="readonly" name="type" value="cm"></div> 
	<span class="clear" style="height:10px">&nbsp;</span> 
	
</div>  
</form>