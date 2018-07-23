<html>
    <head>
	<title></title><link rel="stylesheet" href="css/seller.css">
    </head>

    <body>
       <div id='container'>
       <div class='signup'>
     
    <?php    
    	
	session_start();
	if(isset($_SESSION['cname'])){//isset($_SESSION['cname'])
            echo "<h5 align='center'>";

            echo "<form action='store_product.php' method='post' enctype='multipart/form-data'>
                    <table>";
            
            echo "<tr>
                    <td>Product Name : </td><td><input type='text' name='pname'></td>
                </tr>";
            echo "<tr>
                    <td>Category : </td><td>
                         <select name='cat_id'>";   
                      
                            $dbhandler = new PDO('mysql:host=127.0.0.1;dbname=auction','root','');
                            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            $sql="SELECT * FROM category";
                            $result=$dbhandler->query($sql);
                            while($rows=$result->fetch())
                            {       echo  "<option value=" .$rows['cat_id']. ">" .$rows['category']. "</option>";
                            }

            echo"        </select> 
                    </td>
                </tr>";
             echo "<tr>
                    <td>Image of product : </td><td><input type='file' name='fileToUpload' value='fil' id='fileToUpload' ></td>
                </tr>";
           
            echo "<tr>
                    <td>Description of product : </td><td><textarea rows='6' cols='24' name='des'></textarea></td>
                </tr>";
            echo "<tr>
                    <td>Date : </td><td> <input id='date' type='date' min=".date('Y-m-d')." name='date'></td>
                </tr>";
            echo "<tr>
                    <td>Time : </td><td> <input id='time' type='time' name='time'></td>
                </tr>";
               
            echo "<tr>
                    <td>Base Price : </td><td><input type='Text' name='price'></textarea></td>
                </tr>";
            echo "<tr>
                    <td><input type='submit' name='submit' value='POST'></td>
                </tr>";
            echo "  </table>
                   </form>";
            echo "<h5>";
       }
        else {
          header("location:login.php?to=seller");
        }
        ?></div>
    </body>
</html>
