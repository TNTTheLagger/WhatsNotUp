# Get all installed packages via Chocolatey
$installedPackages = choco list

# Create an array to store package names
$packagesToUpgrade = @()

# Loop through each installed package and add to the array
foreach ($package in $installedPackages) {
    # Extract the package name from the list
    $packageName = $package.Split(' ')[0]

    # Add the package name to the array
    $packagesToUpgrade += $packageName
}

# Upgrade all packages in one go
if ($packagesToUpgrade.Count -gt 0) {
    Write-Host "Downloading and installing updates for the following packages:"
    $packagesToUpgrade
    choco upgrade $packagesToUpgrade -y
} else {
    Write-Host "No packages found to update."
}
