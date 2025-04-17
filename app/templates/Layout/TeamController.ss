<h1>Our Team</h1>

<div class="team-grid">
    <% loop $TeamMembers %>
      <div class="team-card">
        <% if $Photo %>
          <img src="$Photo.URL" alt="$Name" />
        <% end_if %>
        <h3>$Name</h3>
        <p><strong>$JobTitle</strong></p>
        <p>$Bio</p>
      </div>
    <% end_loop %>
  </div>
