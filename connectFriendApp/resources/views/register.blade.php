<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div>
            <label for="hobbies">Hobbies:</label>
            <div>
                <input type="checkbox" name="hobbies[]" value="Photography"> Photography
            </div>
            <div>
                <input type="checkbox" name="hobbies[]" value="Dance"> Dance
            </div>
            <div>
                <input type="checkbox" name="hobbies[]" value="Painting"> Painting
            </div>
            <div>
                <input type="checkbox" name="hobbies[]" value="Drawing"> Drawing
            </div>
            <div>
                <input type="checkbox" name="hobbies[]" value="Knitting"> Knitting
            </div>
            <div>
                <input type="checkbox" name="hobbies[]" value="Reading"> Reading
            </div>
        </div>

        <div>
            <label for="instagram_username">Instagram Username:</label>
            <input type="text" id="instagram_username" name="instagram_username" value="{{ old('instagram_username') }}"
                required>
        </div>

        <div>
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>

</html>