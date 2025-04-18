<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NZTA Demo System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background-image: url('https://images.unsplash.com/photo-1517511620798-cec17d428bc0');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 60px;
            box-sizing: border-box;
        }

        .demo-badge {
            position: absolute;
            top: 20px;
            right: 30px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            font-style: italic;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .report-container {
            background-color: rgba(255,255,255,0.95);
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            max-width: 1200px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 1.9rem;
            margin-bottom: 25px;
        }

        .btn {
            padding: 8px 16px;
            background: linear-gradient(to right, #42a5f5, #1e88e5);
            color: white;
            border: none;
            border-radius: 999px;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .filter {
            margin-bottom: 20px;
            text-align: right;
        }

        .filter select {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .empty {
            color: #666;
            font-style: italic;
            text-align: center;
            padding: 20px;
        }

        .bottom-link {
            text-align: center;
            margin-top: 30px;
        }

        .pagination {
            margin-top: 25px;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 6px 12px;
            background-color: #eee;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .pagination .current {
            font-weight: bold;
            background-color: #1e88e5;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 80vh;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="demo-badge">for sunnysideup demo</div>

<div class="report-container">
    <h1>NZTA Road Quality Reporting Demo System</h1>

    <div class="filter">
        <form method="get">
            <label for="status">Filter by Status:</label>
            <select name="status" onchange="this.form.submit()">
                <option value="">-- All --</option>
                <option value="Pending" <% if $Status = 'Pending' %>selected<% end_if %>>Pending</option>
                <option value="Resolved" <% if $Status = 'Resolved' %>selected<% end_if %>>Resolved</option>
            </select>
        </form>
    </div>

    <% if $Reports.exists %>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Location</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
        <% loop $Reports %>
        <tr>
            <td>$ID</td>
            <td>$Location</td>
            <td>$Content</td>
            <td>$Status</td>
            <td>$Created.Nice</td>
            <td>
                <% if $Image %>
                    <a href="javascript:void(0);" onclick="showModal('$Image.URL')" class="btn">View</a>
                <% else %>
                    N/A
                <% end_if %>
            </td>
        </tr>
        <% end_loop %>
        </tbody>
    </table>

    <div class="pagination">
        <% if $Reports.MoreThanOnePage %>
            <% if $Reports.PrevLink %><a href="$Reports.PrevLink">&laquo; Prev</a><% end_if %>
            <% loop $Reports.Pages %>
                <% if $CurrentBool %>
                    <span class="current">$PageNum</span>
                <% else %>
                    <a href="$Link">$PageNum</a>
                <% end_if %>
            <% end_loop %>
            <% if $Reports.NextLink %><a href="$Reports.NextLink">Next &raquo;</a><% end_if %>
        <% end_if %>
    </div>

    <% else %>
        <div class="empty">No reports available.</div>
    <% end_if %>

    <div class="bottom-link">
        <a class="btn" href="/register">I want to report too</a>
    </div>
</div>

<div id="imgModal" class="modal">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="imgPreview">
</div>

<script>
    function showModal(url) {
        var modal = document.getElementById("imgModal");
        var img = document.getElementById("imgPreview");
        img.src = url;
        modal.style.display = "block";
    }

    function closeModal() {
        document.getElementById("imgModal").style.display = "none";
    }
</script>

</body>
</html>
