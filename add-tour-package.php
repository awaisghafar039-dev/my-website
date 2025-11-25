
<div class="main-content">
    <h2>Add Tour Package</h2>
    <form action="save-tour.php" method="POST" enctype="multipart/form-data" class="form">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Total Nights:</label>
        <input type="number" name="total_nights" required>

        <label>Hotel Category:</label>
        <input type="text" name="hotel_category" required>

        <label>Price:</label>
        <input type="number" name="price" required>

        <label>Country Option:</label>
        <select name="country_option" id="country_option" onchange="toggleCountryFields()">
            <option value="1">1 Country Tour</option>
            <option value="2">2 Country Tour</option>
            <option value="3">3 Country Tour</option>
        </select>

        <!-- Country 1 -->
        <div class="country-block" id="country1_block">
            <label>Country 1 Name:</label>
            <input type="text" name="country1">
            <label>Stay Nights:</label>
            <input type="number" name="nights1">
        </div>

        <!-- Country 2 -->
        <div class="country-block" id="country2_block" style="display:none;">
            <label>Country 2 Name:</label>
            <input type="text" name="country2">
            <label>Stay Nights:</label>
            <input type="number" name="nights2">
        </div>

        <!-- Country 3 -->
        <div class="country-block" id="country3_block" style="display:none;">
            <label>Country 3 Name:</label>
            <input type="text" name="country3">
            <label>Stay Nights:</label>
            <input type="number" name="nights3">
        </div>

        <label>Upload Image:</label>
        <input type="file" name="image" required>

        <button type="submit" class="btn">Save Package</button>
    </form>
</div>

<style>
.main-content { margin-left:220px; padding:20px; }
.form { max-width:600px; display:flex; flex-direction:column; gap:12px; }
.form input, .form textarea, .form select { padding:8px; border:1px solid #ccc; border-radius:5px; }
.btn { padding:10px; background:#0077cc; color:#fff; border:none; border-radius:5px; cursor:pointer; }
.btn:hover { background:#005fa3; }
</style>

<script>
function toggleCountryFields() {
    let option = document.getElementById("country_option").value;
    document.getElementById("country2_block").style.display = (option >= 2) ? "block" : "none";
    document.getElementById("country3_block").style.display = (option == 3) ? "block" : "none";
}
</script>


