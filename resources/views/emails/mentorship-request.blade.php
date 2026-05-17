<!DOCTYPE html>
<html>
<head>
    <title>New Mentorship Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-w: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { background: #007bff; color: white; padding: 15px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { padding: 20px; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Mentorship Request!</h2>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You have received a new mentorship request from <strong>{{ $startup->startup_name }}</strong> (founded by {{ $startup->founder_name }}).</p>
            
            <h3>Startup Details:</h3>
            <ul>
                <li><strong>Industry:</strong> {{ $startup->industry ?? 'N/A' }}</li>
                <li><strong>Stage:</strong> {{ $startup->stage ?? 'N/A' }}</li>
            </ul>

            <h3>Their Message to You:</h3>
            <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #007bff; font-style: italic;">
                {!! nl2br(e($mentorshipRequest->message)) !!}
            </div>

            <p>Log in to the MentorConnect platform to approve or reject this request.</p>
            
            <a href="{{ route('login') }}" class="btn">View Request on Platform</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} MentorConnect. All rights reserved.
        </div>
    </div>
</body>
</html>
