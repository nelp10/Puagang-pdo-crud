
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$thumbnaillink = $productname = $description = $retailprice = "";
$thumbnaillink_err = $productname_err = $description_err = $retailprice_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["productid"]) && !empty($_POST["productid"])){
    // Get hidden input value
    $productid = $_POST["productid"];
    
    // Validate thumbnail link
    $input_thumbnaillink = trim($_POST["thumbnaillink"]);
    if(empty($input_thumbnaillink)){
        $thumbnaillink_err = "Please enter a thumbnail link.";
    } elseif(!filter_var($input_thumbnaillink, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $thumbnaillink_err = "Please enter a valid thumbnail link.";
    } else{
        $thumbnaillink = $input_thumbnaillink;
    }

    // Validate name
    $input_productname = trim($_POST["productname"]);
    if(empty($input_productname)){
        $productname_err = "Please enter a product name.";
    } elseif(!filter_var($input_productname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $productname_err = "Please enter a valid product name.";
    } else{
        $productname = $input_productname;
    }
    
    // Validate address address
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";     
    } else{
        $description = $input_description;
    }
    
    // Validate salary
    $input_retailprice = trim($_POST["retailprice"]);
    if(empty($input_retailprice)){
        $retailprice_err = "Please enter the retail price.";     
    }
    //  elseif(!ctype_digit($input_retailprice)){
    //     $retailprice_err = "Please enter a positive integer value.";
    // }
     else{
        $retailprice = $input_retailprice;
    }
    
    // Check input errors before inserting in database
    if(empty($productname_err) && empty($description_err) && empty($retailprice_err)){
        // Prepare an update statement
        $sql = "UPDATE products SET product_thumbnail_link=:thumbnaillink, product_name=:productname, product_description=:description, product_retail_price=:retailprice WHERE product_id=:productid";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":thumbnaillink", $param_thumbnaillink);
            $stmt->bindParam(":productname", $param_productname);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":retailprice", $param_retailprice);
            $stmt->bindParam(":productid", $param_productid);
            
            // Set parameters
            $param_thumbnaillink = $thumbnaillink;
            $param_productname = $productname;
            $param_description = $description;
            $param_retailprice = $retailprice;
            $param_productid = $productid;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["productid"]) && !empty(trim($_GET["productid"]))){
        // Get URL parameter
        $productid =  trim($_GET["productid"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM products WHERE product_id = :productid";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":productid", $param_productid);
            
            // Set parameters
            $param_productid = $productid;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $thumbnaillink = $row["product_thumbnail_link"];
                    $productname = $row["product_name"];
                    $description = $row["product_description"];
                    $retailprice = $row["product_retail_price"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Thumbnail link</label>
                            <input type="text" name="thumbnaillink" class="form-control <?php echo (!empty($thumbnaillink_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $thumbnaillink; ?>">
                            <span class="invalid-feedback"><?php echo $thumbnaillink_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="productname" class="form-control <?php echo (!empty($productname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $productname; ?>">
                            <span class="invalid-feedback"><?php echo $productname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Retail price</label>
                            <input type="text" name="retailprice" class="form-control <?php echo (!empty($retailprice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $retailprice; ?>">
                            <span class="invalid-feedback"><?php echo $retailprice_err;?></span>
                        </div>
                        <input type="hidden" name="productid" value="<?php echo $productid; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
