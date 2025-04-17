<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Reports</title>
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

        .report-container {
            background-color: rgba(255,255,255,0.95);
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            max-width: 1000px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 1.9rem;
        }

        .button-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn, .view-image {
            padding: 10px 20px;
            background: linear-gradient(to right, #42a5f5, #1e88e5);
            color: white;
            border: none;
            border-radius: 999px;
            font-size: 0.95rem;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn:hover, .view-image:hover {
            background: linear-gradient(to right, #1e88e5, #1565c0);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px 14px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 0.95rem;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a, .pagination span.current {
            display: inline-block;
            margin: 0 6px;
            padding: 8px 16px;
            border-radius: 999px;
            background-color: #e0e0e0;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .pagination a:hover {
            background-color: #42a5f5;
            color: white;
        }

        .pagination span.current {
            background-color: #1e88e5;
            color: white;
            font-weight: bold;
        }

        .no-reports {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        /* Modal */
        #imageModal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #imageModal .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            background: #fff;
            border-radius: 10px;
            overflow: auto;
            padding: 20px;
        }

        #modalImage {
            max-width: 100%;
            max-height: 80vh;
            display: block;
            margin: auto;
            border-radius: 8px;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 14px;
            padding: 6px 14px;
            font-weight: bold;
            cursor: pointer;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="report-container">
    <h1>Your Submitted Reports</h1>

    <% if $UserReports %>
        <div class="button-row">
        <button class="btn" type="button" onclick="alert('This feature is coming soon!')">Export as CSV</button>
    </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <% loop $UserReports %>
                    <tr>
                        <td>$ID</td>
                        <td>$Location</td>
                        <td>$Description.LimitCharacters(50)</td>
                        <td>$ReportType.Title</td>
                        <td><% if $Status %>$Status<% else %>N/A<% end_if %></td>
                        <td>$Created.Nice</td>
                        <td>
                            <% if $Image %>
                                <button class="view-image" data-src="$Image.AbsoluteLink">🔍 View</button>
                            <% else %>
                                No Image
                            <% end_if %>
                        </td>
                    </tr>
                <% end_loop %>
            </tbody>
        </table>

        <% if $UserReports.MoreThanOnePage %>
            <div class="pagination">
                <% if $UserReports.NotFirstPage %>
                    <a href="$UserReports.PrevLink">&laquo; Previous</a>
                <% end_if %>

                <% loop $UserReports.Pages %>
                    <% if $CurrentBool %>
                        <span class="current">$PageNum</span>
                    <% else %>
                        <a href="$Link">$PageNum</a>
                    <% end_if %>
                <% end_loop %>

                <% if $UserReports.NotLastPage %>
                    <a href="$UserReports.NextLink">Next &raquo;</a>
                <% end_if %>
            </div>
        <% end_if %>
    <% else %>
        <p class="no-reports">You haven't submitted any reports yet.</p>
    <% end_if %>
</div>

<!-- Image Modal -->
<div id="imageModal">
    <div class="modal-content">
        <img id="modalImage" src="" alt="Preview Image" loading="lazy">
        <button class="modal-close" onclick="closeModal()">X</button>
    </div>
</div>

<script>
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    document.querySelectorAll('.view-image').forEach(btn => {
        btn.addEventListener('click', () => {
            modalImage.src = btn.dataset.src;
            modal.style.display = 'flex';
        });
    });

    function closeModal() {
        modal.style.display = 'none';
        modalImage.src = '';
    }
</script>

</body>
</html>
