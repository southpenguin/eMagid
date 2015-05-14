<?php

include 'management.php';

if (isset($_POST['newCategory'])) {
    $cat->addCat($_POST["newCat"], $_POST["newSlug"]);
    header('Location: index.php');
}
else if(isset($_POST['updateName'])) {
    $cat->changeName($_POST["oldNameCat"], $_POST["newNameCat"]);
    header('Location: index.php');
}
else if(isset($_POST['updateSlug'])) {
    $cat->changeSlug($_POST["oldSlugCat"], $_POST["newSlugCat"]);
    header('Location: index.php');
}
else if(isset($_POST['deleteName'])) {
    $cat->deleteName($_POST["nameCat"]);
    header('Location: index.php');
}
else if(isset($_POST['deleteSlug'])) {
    $cat->deleteSlug($_POST["slugCat"]);
    header('Location: index.php');
}
else if (isset($_POST['newSubCategory'])) {
    $sub->addSub($_POST["newSub"], $_POST["newParent"]);
    header('Location: index.php');
}
else if (isset($_POST['updateNameSub'])) {
    $sub->changeName($_POST["oldNameSub"], $_POST["newNameSub"]);
    header('Location: index.php');
}
else if (isset($_POST['updateParent'])) {
    $sub->changeParent($_POST["subNameP"], $_POST["subNameParent"]);
    header('Location: index.php');
}
else if(isset($_POST['deleteSubName'])) {
    $sub->deleteName($_POST["nameSub"]);
    header('Location: index.php');
}
else if (isset($_POST['newProduct'])) {
    $prd->addProduct($_POST["newPro"], $_POST["newPCat"], $_POST["newPSub"]);
    header('Location: index.php');
}
else if (isset($_POST['updateNameP'])) {
    $prd->updateName($_POST["oldNameP"], $_POST["newNameP"]);
    header('Location: index.php');
}
else if (isset($_POST['updatePCat'])) {
    $prd->updateCat($_POST["pName"], $_POST["newCatP"]);
    header('Location: index.php');
}
else if (isset($_POST['updatePSub'])) {
    $prd->updateSub($_POST["pNameS"], $_POST["newSubP"]);
    header('Location: index.php');
}
else if (isset($_POST['deletePrd'])) {
    $prd->deleteName($_POST["proName"]);
    header('Location: index.php');
}
?>
