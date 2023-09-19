# TimezoneTask

Here I have attached the TimeZone Task Module.

## User Story

As a user, I want to see the Site location and the current time for the location in the following format:

- [ ] Display the site location.
- [ ] Display the current time for the location.

## Implementation Details

Add an ADMIN CONFIGURATION form which will take the following inputs:
   - Country - text field
   - City - text field
   - Timezone - select list
   - Options in the select list
    - America/Chicago
    - America/New_York
    - Asia/Tokyo
    - Asia/Dubai
    - Asia/Kolkata
    - Europe/Amsterdam
    - Europe/Oslo
    - Europe/London
Create a service that will return the current time based on the time zone selection in the above form. Time should be in the format 19th Sept 2022 - 11:15 AM
Add a Block plugin that will render the Location from the configuration set in the configuration form and the current time calling the service in the previous step. 
Pass the variables to a template to be rendered.

## Screenshots

I have attached snap in module.

## Dependencies

There is no other project Dependencies.

## Usage

We can render the Location from the configuration set in the configuration form and the current time.

## License

[Include the project's license information here if applicable]