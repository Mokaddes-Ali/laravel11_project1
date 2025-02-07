<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .status {
            font-weight: bold;
            color: #007bff;
        }
        .contact-info {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        .company-link {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            font-weight: bold;
        }
        .company-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h3>Dear {{ $clientName }},</h3>
        <p>We are writing to inform you that your loan application status has been updated to: <span class="status">{{ ucfirst($status) }}</span>.</p>

        @if($status === 'approved')
            <p>Congratulations! Your loan has been approved. Please check your account for further details and next steps.</p>
        @else
            <p>Unfortunately, your loan application has been rejected at this time. If you have any questions or need further assistance, feel free to reach out.</p>
        @endif

        <p>If you need any further information, please don't hesitate to contact us.</p>

        <div class="contact-info">
            <p><strong>Company Name:</strong> YourCompany Ltd.</p>
            <p><strong>Email:</strong> support@yourcompany.com</p>
            <p><strong>Phone:</strong> +1 (800) 123-4567</p>
            <p><strong>Visit our platform:</strong> <a class="company-link" href="https://yourcompany.com" target="_blank">Go to Website</a></p>
        </div>
    </div>
</body>
</html>

