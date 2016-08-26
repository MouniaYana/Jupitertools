<?php
namespace  Tools\Model;

class CheckIp
{
    public $ip;
    
   public function Check_Ip(){
       $rbls = [
           'b.barracudacentral.org',
           'cbl.abuseat.org',
           'http.dnsbl.sorbs.net',
           'misc.dnsbl.sorbs.net',
           'socks.dnsbl.sorbs.net',
           'web.dnsbl.sorbs.net',
           'dnsbl-1.uceprotect.net',
           'dnsbl-3.uceprotect.net',
           'sbl.spamhaus.org',
           'zen.spamhaus.org',
           'psbl.surriel.com',
           'dnsbl.njabl.org',
           'rbl.spamlab.com',
           'noptr.spamrats.com',
           'cbl.anti-spam.org.cn',
           'dnsbl.inps.de',
           'httpbl.abuse.ch',
           'korea.services.net',
           'virus.rbl.jp',];
       $rev         = join('.', array_reverse(explode('.', trim($this->ip))));
       $i           = 1;
       $rbl_count   = count($rbls);
       $listed_rbls = [];
       $Disco = array() ;
       foreach ($rbls as $rbl)
       {//  printf('Checking %s, %d of %d... ', $rbl, $i, $rbl_count);
           $lookup = sprintf('%s.%s', $rev, $rbl);
           $listed = gethostbyname($lookup) !== $lookup;
        //   printf('[%s]%s', $listed ? 'LISTED' : 'OK', PHP_EOL);
           
          // $Disco[]= "'[%s]%s', $listed ? 'LISTED' : 'OK', PHP_EOL" ;
       if($listed){
               $Disco[$rbl]="LISTED" ;
			  // echo $Disco [$rbl];
           }
           else{
               $Disco[$rbl]="OK" ;
			 //  $Disco [$rbl];
           }
           
           if ( $listed )
           {
               $listed_rbls[] = $rbl;
           }
           $i++;
       }
       printf('%s listed on %d of %d known blacklists%s', $this->ip, count($listed_rbls), $rbl_count, PHP_EOL);
       if ( ! empty($listed_rbls) )
       {
           printf('%s listed on %s%s', $this->ip, join(', ', $listed_rbls), PHP_EOL);
       }
       
       
      
   return $Disco ;}
   public function exchangeArray($data)
   {
        
      
       $this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
      
     
   }
   
}