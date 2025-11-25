<?php include 'includes/header.php'; ?>

<section class="umrah-query-section">
  <div class="query-form-wrapper">
    <h2 class="form-heading">Send Your Umrah Package Query</h2>
    <form action="submit-query.php" method="POST" class="styled-query-form">
      <div class="form-group">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="tel" name="contact" placeholder="Contact Number" required>
      </div>

      <div class="form-group">
        <input type="number" name="persons" placeholder="No. of Persons" required>
        <input type="number" name="children" placeholder="No. of Children" required>
        <input type="number" name="infants" placeholder="No. of Infants" required>
      </div>

      <div class="form-group">
        <input type="number" name="total_days" placeholder="Total Days" required>
        <input type="number" name="makkah_nights" placeholder="Makkah Nights" required>
        <input type="number" name="madina_nights" placeholder="Madina Nights" required>
      </div>

      <div class="form-group">
        <select name="makkah_hotel" required>
          <option value="">Makkah Hotel Category</option>
          <option>Economy</option><option>1 Star</option>
          <option>2 Star</option><option>3 Star</option>
          <option>4 Star</option><option>5 Star</option>
        </select>

        <select name="madina_hotel" required>
          <option value="">Madina Hotel Category</option>
          <option>Economy</option><option>1 Star</option>
          <option>2 Star</option><option>3 Star</option>
          <option>4 Star</option><option>5 Star</option>
        </select>
      </div>

      <div class="form-group">
        <input type="text" name="city" placeholder="Your City" required>
        <textarea name="address" rows="3" placeholder="Full Address" required></textarea>
      </div>

      <button type="submit" class="form-submit-btn">Submit Query</button>
    </form>
  </div>
</section>







<?php include 'includes/footer.php'; ?>