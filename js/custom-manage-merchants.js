document.addEventListener("DOMContentLoaded", function () {
    const timelineDropdown = document.querySelector('[name="my_timeline_dropdown_field"]');
    const configDropdown = document.querySelector('[name="my_config_dropdown_field"]');
    const startDateField = document.querySelector('#start_date_field');
    const endDateField = document.querySelector('#end_date_field');

    // Function to handle the change event
    function handleConfigDropdownChange() {
        const configValue = configDropdown.value;

        if (configValue == 'overwrite') {
            endDateField.style.display = 'none';
        } else {
            endDateField.style.display = 'block';
        }
    }

    function handleTimelineDropdownChange() {
        const timelineValue = timelineDropdown.value;

        if (timelineValue == 'now') {
            startDateField.style.display = 'none';
        }
        else {
            startDateField.style.display = 'block';
        }
    }

    // Attach the event listeners to the dropdowns
    timelineDropdown.addEventListener('change', handleTimelineDropdownChange);
    configDropdown.addEventListener('change', handleConfigDropdownChange);

    // Trigger the initial change event to handle the initial values
    handleTimelineDropdownChange();
    handleConfigDropdownChange();
});