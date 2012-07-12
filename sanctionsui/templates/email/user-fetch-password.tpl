{$user->profile->first_name} {$user->profile->last_name} - Your Elektrifi Sanctions Screening Account Password
Dear {$user->profile->first_name},

You recently requested a password reset for the Elektrifi Sanctions Screening service as you indicated you had forgotten your password.

Your new password is listed below. To activate this password, click this link:

    Activate Password: http://sanctionsui/account/fetchpassword?action=confirm&id={$user->getId()}&key={$user->profile->new_password_key}
    Username: {$user->username}
    New Password: {$user->_newPassword}

If you didn't request a password reset, please ignore this message and your password
will remain unchanged.

Sincerely,
Jonathan Forbes
Elektrifi Customer Services