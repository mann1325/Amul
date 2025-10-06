<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cattle_feed";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$message = "";

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM cattle_distributor WHERE id=$id");
    $message = "<p style='color:red;'>Record deleted!</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $name_of_firm = $_POST['name_of_firm'] ?? '';
    $year_of_establishment = $_POST['Year_of_Establishment'] ?? '';
    $nature_of_firm = $_POST['Nature_of_the_firm'] ?? '';
    $type_of_business = isset($_POST['type_of_business']) ? implode(',', (array)$_POST['type_of_business']) : '';
    $address = $_POST['address'] ?? '';
    $state = $_POST['state'] ?? '';
    $district = $_POST['district'] ?? '';
    $tehsil = $_POST['Tehsil_taluka'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $annualturnover = $_POST['annualturnover'] ?? '';
    $nameofkeyperson = $_POST['nameofkeyperson'] ?? '';
    $contactnumber = $_POST['contactnumber'] ?? '';
    $email = $_POST['email'] ?? '';
    $storagegodown = $_POST['storagegodown'] ?? '';
    $distribution_vehicle = $_POST['Distribution_Vehicle'] ?? '';
    $delivery_person = $_POST['Delivery_Person'] ?? '';

    if ($id) {
        $sql = "UPDATE cattle_distributor SET 
            name_of_firm=?, year_of_establishment=?, nature_of_firm=?, type_of_business=?, 
            address=?, state=?, district=?, tehsil_taluka=?, pincode=?, annual_turnover=?, 
            name_of_key_person=?, contact_number=?, email=?, 
            storage_godown=?, distribution_vehicle=?, delivery_person=? 
            WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssssi",
            $name_of_firm, $year_of_establishment, $nature_of_firm, $type_of_business,
            $address, $state, $district, $tehsil, $pincode, $annualturnover,
            $nameofkeyperson, $contactnumber, $email,
            $storagegodown, $distribution_vehicle, $delivery_person, $id
        );
        $stmt->execute();
        $message = "<p style='color:blue;'>Record updated!</p>";
    } else {
        $sql = "INSERT INTO cattle_distributor 
        (name_of_firm, year_of_establishment, nature_of_firm, type_of_business, address, state, district, tehsil_taluka, pincode, annual_turnover, name_of_key_person, contact_number, email, storage_godown, distribution_vehicle, delivery_person) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssss",
            $name_of_firm, $year_of_establishment, $nature_of_firm, $type_of_business,
            $address, $state, $district, $tehsil, $pincode, $annualturnover,
            $nameofkeyperson, $contactnumber, $email,
            $storagegodown, $distribution_vehicle, $delivery_person
        );
        $stmt->execute();
        $message = "<p style='color:green;'>New record created!</p>";
    }
}

$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM cattle_distributor WHERE id=$id");
    $editData = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cattle feed registration</title>
    <style>
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: Arial, sans-serif;
      }
     #main {
        background: linear-gradient(
          180deg,
          rgba(144, 213, 254, 1) 10px,
          rgba(255, 255, 255, 1) 300px
        );
      }
      #footer {
        margin-top: auto;
      }
    </style>
    <link rel="stylesheet" href="cattle feed.css">
</head>
<body>
     <div id="header"></div>
     <div id="main">
      <div>
        <a href="index.php"> <img src="home.png" width="50" /></a>
      </div>
      <h1>Cattle Feed Distributor Registration Form</h1>
      <div id="content">
        <div class="left-box">
          <?php echo $message; ?>
          <form method="post">
            <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
            <label><h4>Name of the Firm*</h4>
              <input type="text" name="name_of_firm" placeholder="Name of the firm" maxlength="200" value="<?php echo $editData['name_of_firm'] ?? ''; ?>" required>
            </label>
            <br/>
            <label><h4>Year of Establishment*</h4>
              <input type="text" name="Year_of_Establishment" placeholder="Year of Establishment" maxlength="4" value="<?php echo $editData['year_of_establishment'] ?? ''; ?>" required>
            </label>
            <br/>
            <label><h2>Nature of the firm</h2>
              <?php
              $nature = $editData['nature_of_firm'] ?? '';
              $natureOptions = ["Proprietorship", "Partnership", "Joint Venture", "Private Limited", "others"];
              foreach ($natureOptions as $opt) {
                echo '<input type="radio" name="Nature_of_the_firm" value="'.$opt.'"'.($nature==$opt?' checked':'').'><label> '.$opt.'</label>';
              }
              ?>
            </label>
            <br/>
            <label><h2>Type of Business</h2>
              <?php
              $typeBusiness = explode(',', $editData['type_of_business'] ?? '');
              $typeOptions = ["manufacturing", "Distribution", "Wholesaling", "Retailing"];
              foreach ($typeOptions as $opt) {
                echo '<input type="checkbox" name="type_of_business[]" value="'.$opt.'"'.(in_array($opt, $typeBusiness)?' checked':'').'><label> '.$opt.'</label>';
              }
              ?>
            </label>
            <br/>
            <label><h2>Address</h2>
              <textarea class="form-control" rows="5" cols="10" name="address" style="height: 159px; width: 304px;" required><?php echo $editData['address'] ?? ''; ?></textarea>
            </label>
            <br/>
            <label><h4>State*</h4></label>
            <select name="state" class="form-control" required>
              <option value="">Select State</option>
              <?php
              $states = [
                "ANDAMAN & NICOBAR ISLANDS", "ANDHRA PRADESH", "ARUNACHAL PRADESH", "ASSAM", "BIHAR", "CHANDIGARH", "CHATTISGARH", "DADRA & NAGAR HAVELI", "DAMAN & DIU", "DELHI", "GOA", "GUJARAT", "HARYANA", "HIMACHAL PRADESH", "JAMMU & KASHMIR", "JHARKHAND", "KARNATAKA", "KERALA", "LAKSHADWEEP", "MADHYA PRADESH", "MAHARASHTRA", "MANIPUR", "MEGHALAYA", "MIZORAM", "NAGALAND", "ODISHA", "PONDICHERRY", "PUNJAB", "RAJASTHAN", "SIKKIM", "TAMIL NADU", "TELANGANA", "TRIPURA", "UTTAR PRADESH", "UTTARAKHAND", "WEST BENGAL"
              ];
              $selectedState = $editData['state'] ?? '';
              foreach ($states as $state) {
                echo '<option value="'.$state.'"'.($selectedState==$state?' selected':'').'>'.$state.'</option>';
              }
              ?>
            </select>
            <br/>
            <label><h4>District*</h4></label>
            <input type="text" name="district" placeholder="District" maxlength="100" value="<?php echo $editData['district'] ?? ''; ?>" required>
            <br/>
            <label><h4>City*</h4></label>
            <input type="text" name="Tehsil_taluka" placeholder="Tehsil/taluka" maxlength="100" value="<?php echo $editData['tehsil_taluka'] ?? ''; ?>" required>
            <br/>
            <label><h4>Pincode*</h4></label>
            <input type="text" name="pincode" placeholder="Pincode" maxlength="6" value="<?php echo $editData['pincode'] ?? ''; ?>" required>
            <br/>
            <label><h4>Annual Turnover(of last year)*</h4>
              <input type="text" class="form-control" maxlength="9" name="annualturnover" placeholder="Annual Turnover(of Last Year)" value="<?php echo $editData['annual_turnover'] ?? ''; ?>" required>
            </label>
            <br/>
            <label><h4>Name of Key Person *</h4></label>
            <input type="text" class="form-control" maxlength="200" name="nameofkeyperson" placeholder="Name of Key Person" value="<?php echo $editData['name_of_key_person'] ?? ''; ?>" required>
            <br/>
            <label><h4>Contact Number *</h4></label>
            <input type="text" class="form-control" maxlength="13" name="contactnumber" placeholder="Contact Number" value="<?php echo $editData['contact_number'] ?? ''; ?>" required>
            <br/>
            <label><h4>E-mail *</h4></label>
            <input type="email" class="form-control" maxlength="256" name="email" placeholder="E-mail" value="<?php echo $editData['email'] ?? ''; ?>" required>
            <br/>
            <b style="color: #283945;">Infrastructure Facility </b>
            <br/>
            <label>Storage Godown</label><br/>
            <?php
            $storage = $editData['storage_godown'] ?? '';
            foreach (["Available", "Can provide"] as $opt) {
              echo '<input type="radio" name="storagegodown" value="'.$opt.'"'.($storage==$opt?' checked':'').'><label>'.$opt.'</label>';
            }
            ?>
            <br/>
            <label>Distribution Vehicle</label><br/>
            <?php
            $vehicle = $editData['distribution_vehicle'] ?? '';
            foreach (["Available", "Can provide"] as $opt) {
              echo '<input type="radio" name="Distribution_Vehicle" value="'.$opt.'"'.($vehicle==$opt?' checked':'').'><label>'.$opt.'</label>';
            }
            ?>
            <br/>
            <label>Delivery Person</label><br/>
            <?php
            $delivery = $editData['delivery_person'] ?? '';
            foreach (["Available", "Can provide"] as $opt) {
              echo '<input type="radio" name="Delivery_Person" value="'.$opt.'"'.($delivery==$opt?' checked':'').'><label>'.$opt.'</label>';
            }
            ?>
            <br/>
            <button class="button" type="submit"><h4><?php echo $editData ? "Update" : "Submit"; ?></h4></button>
          </form>
        </div>
        <div class="right-box">
          <img src="cattle3.png">
          <br/>
          <br/>
          <img src="cattle2.png" width="270" height="240">
          <br/>
          <br/>
          <img src="cattle1.png" width="270" height="240">
        </div>
      </div>
      <h2>All Distributors</h2>
      <table>
        <tr>
          <th>ID</th><th>Name</th><th>Year</th><th>Contact</th><th>Email</th><th>Action</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM cattle_distributor ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name_of_firm']}</td>
              <td>{$row['year_of_establishment']}</td>
              <td>{$row['contact_number']}</td>
              <td>{$row['email']}</td>
              <td>
                <a href='?edit={$row['id']}'>Edit</a> | 
                <a href='?delete={$row['id']}' onclick='return confirm(\"Delete this record?\")'>Delete</a>
              </td>
            </tr>";
        }
        ?>
      </table>
    </div>
    <div id="footer"></div>
    <script>
        fetch("header.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("header").innerHTML = data;
        });
      fetch("footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer").innerHTML = data;
        });
    </script>
</body>
</html>
