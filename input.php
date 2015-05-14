<?php ?>
                <br>
            <form method="POST" action="calls.php">
                New Category <br>
                <input type="text" name="newCat" placeholder="New Category">
                <input type="text" name="newSlug" placeholder="New Slug">
                <input type="submit" name="newCategory">
            </form>
            <form method="POST" action="calls.php">
                Update Category Name<br> 
                <input type="text" name="oldNameCat" placeholder="Old Name">
                <input type="text" name="newNameCat" placeholder="New Name">
                <input type="submit" name="updateName">
            </form>
            <form method="POST" action="calls.php">
                Update Category Slug<br> 
                <input type="text" name="oldSlugCat" placeholder="Old Slug">
                <input type="text" name="newSlugCat" placeholder="New Slug">
                <input type="submit" name="updateSlug">
            </form>
            <form method="POST" action="calls.php">
                Delete Category by Name<br> 
                <input type="text" name="nameCat" placeholder="Category Name">
                <input type="submit" name="deleteName">
            </form>
            <form method="POST" action="calls.php">
                Delete Category by Slug<br> 
                <input type="text" name="slugCat" placeholder="Category Slug">
                <input type="submit" name="deleteSlug">
            </form>
                
                
                <br><br>
            <form method="POST" action="calls.php">
                New Sub-Category <br>
                <input type="text" name="newSub" placeholder="New Sub-Category">
                <input type="text" name="newParent" placeholder="Parent Category">
                <input type="submit" name="newSubCategory">
            </form>
            <form method="POST" action="calls.php">
                Update Sub-Category Name<br> 
                <input type="text" name="oldNameSub" placeholder="Old Name">
                <input type="text" name="newNameSub" placeholder="New Name">
                <input type="submit" name="updateNameSub">
            </form>
            <form method="POST" action="calls.php">
                Update Sub-Category Parent<br> 
                <input type="text" name="subNameP" placeholder="Sub-Category Name">
                <input type="text" name="subNameParent" placeholder="New Parent Category Name">
                <input type="submit" name="updateParent">
            </form>
            <form method="POST" action="calls.php">
                Delete Sub-Category by Name<br> 
                <input type="text" name="nameSub" placeholder="Sub-Category Name">
                <input type="submit" name="deleteSubName">
            </form>
                
                
                
                <br><br>
            <form method="POST" action="calls.php">
                New Product <br>
                <input type="text" name="newPro" placeholder="New Product">
                <input type="text" name="newPCat" placeholder="Category">
                <input type="text" name="newPSub" placeholder="Sub-Category (blank)">
                <input type="submit" name="newProduct">
            </form>
            <form method="POST" action="calls.php">
                Update Product Name<br> 
                <input type="text" name="oldNameP" placeholder="Old Name">
                <input type="text" name="newNameP" placeholder="New Name">
                <input type="submit" name="updateNameP">
            </form>
            <form method="POST" action="calls.php">
                Update Product Category<br> 
                <input type="text" name="pName" placeholder="Product Name">
                <input type="text" name="newCatP" placeholder="New Category">
                <input type="submit" name="updatePCat">
            </form>
            <form method="POST" action="calls.php">
                Update Product Sub-Category<br> 
                <input type="text" name="pNameS" placeholder="Product Name">
                <input type="text" name="newSubP" placeholder="New Sub-Category">
                <input type="submit" name="updatePSub">
            </form>
            <form method="POST" action="calls.php">
                Delete Product by Name<br> 
                <input type="text" name="proName" placeholder="Product Name">
                <input type="submit" name="deletePrd">
            </form>
                <?php ?>
                
