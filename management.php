<?php 
class Category{
    
    public function listCat(){
        include 'connectDB.php';
        $sql = "SELECT id, name, slug FROM Category";
        if($stmt = $db->prepare($sql)){
           $stmt->execute();
           $stmt->bind_result($id, $name, $slug);
            
           while ($stmt->fetch()){?>
                <li>
                    <label for="folder<?php echo $id;?>"><?php echo $name." ( /".$slug." ) ";?></label> 
                    <input type="checkbox" id="folder<?php echo $id;?>" />
                    <ol>
                        <?php Product::listCat($id);?>
                        <li>
                            <?php SubCategory::listSub($id);?>
                        </li>
                    </ol>
                </li><?php
            }
            include 'input.php';
        }
    }
    
    public function isSlugExist($slug){
        include 'connectDB.php';
        $sql = "SELECT id FROM Category WHERE slug = ?;";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;
            $stmt->close();
            if ($rows >= 1) return true;
            else return false;
        }
    }
    
    public function isNameExist($name){
        include 'connectDB.php';
        $sql = "SELECT id FROM Category WHERE name = ?;";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;
            $stmt->close();
            if ($rows >= 1) return true;
            else return false;
        }
    }
    
    public function addCat($name, $slug){
        if(Category::isSlugExist($slug)) echo "This category slug already exists.</br>";
        else{
            include 'connectDB.php';
            $sql = "INSERT INTO Category VALUES (NULL, ?, ?);";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("ss", $name, $slug);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function changeName($old, $new){
        if(!Category::isNameExist($old)) echo "This category name done NOT exist.</br>";
        else{
            include 'connectDB.php';
            $sql = "UPDATE Category SET name = ? WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("ss", $new, $old);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function changeSlug($old, $new){
        if(!Category::isSlugExist($old)) echo "This category slug does NOT exist.</br>";
        else{
            include 'connectDB.php';
            $sql = "UPDATE Category SET slug = ? WHERE slug = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("ss", $new, $old);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function getNameId($name){
        if(!Category::isNameExist($name)){
            echo "This category name does NOT exist.</br>";
            return -1;
        }
        else{
            include 'connectDB.php';
            $sql = "SELECT id FROM Category WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt->close();
                return $id;
            }
        }
    }
    
    public function getSlugId($slug) {
        if(!Category::isSlugExist($slug)) echo "This category slug does NOT exist.</br>";
        else{
            include 'connectDB.php';
            $sql = "SELECT id FROM Category WHERE slug = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $slug);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt->close();
                return $id;
            }
        }
    }
    
    public function deleteName($name){
        $id = Category::getNameId($name);
        Category::deleteId($id);
    }
    
    public function deleteSlug($slug){
        $id = Category::getSlugId($slug);
        Category::deleteId($id);
    }

    public function deleteId($id){
        $countSub = SubCategory::getCountParent($id);
        $countProduct = Product::getCountCat($id);
        if($countSub == 0 && $countProduct == 0){
            include 'connectDB.php';
            $sql = "DELETE FROM Category WHERE id = ?";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
        else if ($count > 0) echo "There are sub-categories belong to this category, please delete them first.</br>";
        if($countProduct > 0) echo "There are products belong to this category, please delete them first.</br>";
    }
}

class SubCategory extends Category{
    
    public function listSub($id){
        include 'connectDB.php';
        $sql = "SELECT id, name FROM SubCategory WHERE parent = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id, $name);
            while ($stmt->fetch()){
                ?><label for="subfolder2"><?php echo $name;?></label> <input type="checkbox" id="subfolder2" /><ol><?php
                Product::listSub($id);?></ol><?php
            }
        }
    }
    
    public function isNameExist($name){
        include 'connectDB.php';
        $sql = "SELECT id FROM SubCategory WHERE name = ?;";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;
            $stmt->close();
            if ($rows >= 1) return true;
            else return false;
        }
    }
    
    public function getParent($name){
        if(!SubCategory::isNameExist($name)) echo "This sub-category name done NOT exist.</br>";
        else{
            include 'connectDB.php';
            $sql = "SELECT parent FROM SubCategory WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("i", $name);
                $stmt->execute();
                $stmt->bind_result($parent);
                $stmt->fetch();
                $stmt->close();
                return $parent;
            }
        }
    }
    
    public function getNameId($name){
        if(!SubCategory::isNameExist($name)){
            echo "This sub-category name done NOT exist.</br>";
            return -1;
        }
        else{
            include 'connectDB.php';
            $sql = "SELECT id FROM SubCategory WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt->close();
                return $id;
            }
        }
    }
    
    public function addSub($name, $parent){
        if(SubCategory::isNameExist($name)) echo "This sub-category already exists.</br>";
        else if (!Category::isNameExist($parent)) echo "There is no such category to add sub-category \"".$name."\".</br>";
        else{
            $parentId = Category::getNameId($parent);
            include 'connectDB.php';
            $sql = "INSERT INTO SubCategory VALUES (NULL, ?, ?);";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("is", $parentId, $name);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function changeName($old, $new){
        if(!SubCategory::isNameExist($old)) echo "This sub-category name done NOT exist.</br>";
        else{
            include 'connectDB.php';
            $sql = "UPDATE SubCategory SET name = ? WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("ss", $new, $old);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function changeParent($name, $newParent){
        if(!SubCategory::isNameExist($name)) echo "This sub-category name done NOT exist.</br>";
        else if(!Category::isNameExist($newParent)) echo "There is no such category name.</br>";
        else{
            $id = Category::getNameId($newParent);
            include 'connectDB.php';
            $sql = "UPDATE SubCategory SET parent = ? WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("is", $id, $name);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function getCountParent($id){
        include 'connectDB.php';
        $sql = "SELECT COUNT(*) FROM SubCategory WHERE parent = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count;
        }
    }
    
    public function deleteName($name) {
        $id = SubCategory::getNameId($name);
        if($id == -1) echo "There is no sub-category named \"".$name."\".";
        else SubCategory::deleteId($id);
    }


    public function deleteId($id){
        $countProduct = Product::getCountSub($id);
        if($countProduct == 0){
            include 'connectDB.php';
            $sql = "DELETE FROM SubCategory WHERE id = ?";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
        else echo "There are products under this sub-category, please delete them first.";
    }
    
    
}

class Product{
    
    public function listSub($id){
        include 'connectDB.php';
        $sql = "SELECT name FROM Product WHERE subcategory = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($name);
            while ($stmt->fetch()){
                ?><li class="file"><a href=""><?php echo $name; ?></a></li><?php
            }
        }
    }
    
    public function listCat($id){
        include 'connectDB.php';
        $sql = "SELECT name FROM Product WHERE category = ? AND subcategory IS NULL";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($name);
            while ($stmt->fetch()){
                ?><li class="file"><a href=""><?php echo $name; ?></a></li><?php
            }
            
        }
    }
    
    public function isNameExist($name){
        include 'connectDB.php';
        $sql = "SELECT id FROM Product WHERE name = ?;";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;
            $stmt->close();
            if ($rows >= 1) return true;
            else return false;
        }
    }
    
    public function addProduct($name, $category, $subCategory = null){
        if(Product::isNameExist($name)) echo "The product name \"".$name."\" already exists.";
        else if(!Category::isNameExist($category)) echo "The category \"".$category."\" does not exist, please add the category first.</br>";
        else if ($subCategory != null && !SubCategory::isNameExist($subCategory)) echo "The sub-category \"".$subCategory."\" does not exist, please add it first.</br>";
        else{
            $catId = Category::getNameId($category);
            if($subCategory == null) $subId = null;
            else $subId = SubCategory::getNameId($subCategory);
            include 'connectDB.php';
            $sql = "INSERT INTO Product VALUES (NULL, ?, ?, ?);";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("sii", $name, $catId, $subId);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            }
        }
    }
    
    public function getId($name){
        if(!Product::isNameExist($name)){
            echo "This product name does NOT exist.</br>";
            return -1;
        }
        else{
            include 'connectDB.php';
            $sql = "SELECT id FROM Product WHERE name = ?;";
            if($stmt = $db->prepare($sql)){
                $stmt->bind_param("s", $name);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt->close();
                return $id;
            }
        }
    }
    
    public function getCountCat($id){
        include 'connectDB.php';
        $sql = "SELECT COUNT(*) FROM Product WHERE category = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count;
        }
    }
    
    public function getCountSub($id){
        include 'connectDB.php';
        $sql = "SELECT COUNT(*) FROM Product WHERE subcategory = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count;
        }
    }
    
    public function updateName($old, $new){
        include 'connectDB.php';
        $sql = "UPDATE Product SET name = ? WHERE name = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("ss", $new, $old);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        }
    }
    
    public function updateCat($product, $name){
        
        $catId = Category::getNameId($name);
        include 'connectDB.php';
        $sql = "UPDATE Product SET category = ? WHERE name = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("is", $catId, $product);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        }
    }
    
    public function updateSub($product, $name){
        $subId = SubCategory::getNameId($name);
        include 'connectDB.php';
        $sql = "UPDATE Product SET subcategory = ? WHERE name = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("is", $subId, $product);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        }
    }
    public function deleteName($name){
        $id = Product::getId($name);
        Product::delete($id);
    }
    
    public function delete($id){
        include 'connectDB.php';
        $sql = "DELETE FROM Product WHERE id = ?";
        if($stmt = $db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        }
    }
}


$cat = new Category();
$sub = new SubCategory();
$prd = new Product();

?>
