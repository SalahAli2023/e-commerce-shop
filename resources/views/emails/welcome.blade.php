<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4f46e5; color: white; padding: 20px; text-align: center; }
        .content { background: #f9fafb; padding: 30px; }
        .button { background: #4f46e5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block; }
        .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to {{ config('app.name') }}!</h1>
        </div>
        
        <div class="content">
            <h2>Hello {{ $user->name }},</h2>
            
            <p>Thank you for joining {{ config('app.name') }}! We're excited to have you as part of our community.</p>
            
            <p>With your account, you can:</p>
            <ul>
                <li>Browse our extensive product catalog</li>
                <li>Save items to your wishlist</li>
                <li>Track your orders</li>
                <li>Manage your account settings</li>
            </ul>
            
            <p>Get started by exploring our products:</p>
            
            <p style="text-align: center;">
                <a href="{{ $loginUrl }}" class="button">Start Shopping</a>
            </p>
            
            <p>If you have any questions, feel free to reply to this email or contact our support team.</p>
            
            <p>Happy shopping!<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you did not create an account with us, please ignore this email.</p>
        </div>
    </div>
</body>
</html>