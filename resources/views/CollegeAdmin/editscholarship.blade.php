<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Scholarship</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/editscholarship.css') }} ">
</head>
<body>
    <div class="editscholarship-container">
        <h1>Edit Scholarship</h1>
        <form action=" {{ route('collegeadmin.scholarshipupdate.update', $scholarships->first()->id) }} " method="POST">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td><label for="college_id">Choosen College:</label></td>
                    <td><label for="scholarship_name">Scholarship Name:</label></td>
                </tr>
                <tr>
                    <td>
                        <select name="college_id" id="college_id" required>
                            <option value="" disabled>Select College</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->id }}" {{ $scholarships->first()->college_id == $college->id ? 'selected' : '' }}>
                                    {{ $college->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('college_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="scholarship_name" id="scholarship_name" placeholder="Enter Scholarship Name" value="{{ old('scholarship_name', $scholarships->first()->scholarship_name) }}" required>
                        @error('scholarship_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="eligibility">Eligibility:</label></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="eligibility" id="eligibility" cols="60" rows="6">{{ old('eligibility', $scholarships->first()->eligibility) }}</textarea>
                        @error('eligibility')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="benefits">Benefits:</label></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="benefits" id="benefits" cols="30" rows="6">{{ old('benefits', $scholarships->first()->benefits) }}</textarea>
                        @error('benefits')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>
            <button type="submit">Update Scholarship</button>
        </form>
    </div>
</body>
</html>
