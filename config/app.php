
<?php

return [


    'providers' => [     
      
        LaravelQRCode\Providers\QRCodeServiceProvider::class,     
      
    ],
    
    
    'aliases' => [
       
       'QRCode' => LaravelQRCode\Facades\QRCode::class,     
          
    ] 
      

];
