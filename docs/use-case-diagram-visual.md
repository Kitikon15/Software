# Use Case Diagram - Laravel Admission System (Visual)

## Traditional UML Use Case Diagram

```mermaid
graph LR
    %% Actors (Left Side)
    Guest((Guest User))
    Student((Student/Applicant))
    Admin((Administrator))
    
    %% System Boundary
    subgraph System["Laravel Admission System"]
        %% Public Use Cases
        UC1((View Home Page))
        UC2((View Admission Info))
        UC3((Register Account))
        
        %% Authentication Use Cases
        UC4((Login to System))
        UC7((Logout))
        UC8((View Test Credentials))
        
        %% Student Use Cases
        UC5((View Profile))
        UC6((Update Profile))
        
        %% Admin Use Cases
        UC9((Access Admin Panel))
        UC10((View Dashboard))
        UC11((Manage Applicants))
        UC12((View Applicant Details))
        UC13((Delete Applicant))
        UC14((Export Data))
        
        %% Include/Extend Relationships
        UC15((Validate Data))
        UC16((Handle Authentication))
        UC17((Manage Sessions))
    end

    %% Actor to Use Case Relationships
    Guest --- UC1
    Guest --- UC2
    Guest --- UC3
    
    Student --- UC3
    Student --- UC4
    Student --- UC5
    Student --- UC6
    Student --- UC7
    Student --- UC8
    
    Admin --- UC4
    Admin --- UC7
    Admin --- UC9
    Admin --- UC10
    Admin --- UC11
    Admin --- UC12
    Admin --- UC13
    Admin --- UC14

    %% Include Relationships (dashed lines)
    UC3 -.->|includes| UC15
    UC3 -.->|includes| UC16
    UC4 -.->|includes| UC16
    UC4 -.->|includes| UC17
    UC6 -.->|includes| UC15
    
    %% Extend Relationships
    UC3 -.->|extends| UC4
    UC5 -.->|extends| UC6
    UC11 -.->|extends| UC12
    UC11 -.->|extends| UC13
    
    %% Styling for traditional UML look
    classDef actor fill:#ffffff,stroke:#000000,stroke-width:2px
    classDef usecase fill:#ffffff,stroke:#000000,stroke-width:1.5px
    classDef system fill:#f0f0f0,stroke:#000000,stroke-width:2px
    classDef include fill:#e6f3ff,stroke:#0066cc,stroke-width:1px
    
    class Guest,Student,Admin actor
    class UC1,UC2,UC3,UC4,UC5,UC6,UC7,UC8,UC9,UC10,UC11,UC12,UC13,UC14 usecase
    class UC15,UC16,UC17 include
```

## Alternative: PlantUML Style Diagram

```plantuml
@startuml Laravel_Admission_System

left to right direction
skinparam packageStyle rectangle

actor "Guest User" as Guest
actor "Student/Applicant" as Student  
actor "Administrator" as Admin

rectangle "Laravel Admission System" {
  usecase "View Home Page" as UC1
  usecase "View Admission Info" as UC2
  usecase "Register Account" as UC3
  usecase "Login to System" as UC4
  usecase "View Profile" as UC5
  usecase "Update Profile" as UC6
  usecase "Logout" as UC7
  usecase "View Test Credentials" as UC8
  usecase "Access Admin Panel" as UC9
  usecase "View Dashboard" as UC10
  usecase "Manage Applicants" as UC11
  usecase "View Applicant Details" as UC12
  usecase "Delete Applicant" as UC13
  usecase "Export Data" as UC14
  
  usecase "Validate Data" as UC15
  usecase "Handle Authentication" as UC16
  usecase "Manage Sessions" as UC17
}

' Guest relationships
Guest --> UC1
Guest --> UC2
Guest --> UC3

' Student relationships
Student --> UC3
Student --> UC4
Student --> UC5
Student --> UC6
Student --> UC7
Student --> UC8

' Admin relationships
Admin --> UC4
Admin --> UC7
Admin --> UC9
Admin --> UC10
Admin --> UC11
Admin --> UC12
Admin --> UC13
Admin --> UC14

' Include relationships
UC3 ..> UC15 : <<include>>
UC3 ..> UC16 : <<include>>
UC4 ..> UC16 : <<include>>
UC4 ..> UC17 : <<include>>
UC6 ..> UC15 : <<include>>

' Extend relationships  
UC4 ..> UC3 : <<extend>>
UC6 ..> UC5 : <<extend>>
UC12 ..> UC11 : <<extend>>
UC13 ..> UC11 : <<extend>>

@enduml
```

## How to Generate Visual Image

### Method 1: Online Mermaid Editor
1. Copy the mermaid code above
2. Go to https://mermaid.live/
3. Paste the code in the editor
4. Click "Download PNG" or "Download SVG"

### Method 2: VS Code Extension
1. Install "Mermaid Preview" extension in VS Code
2. Open this file in VS Code
3. Right-click on the mermaid block
4. Select "Export diagram" or "Preview"

### Method 3: GitHub/GitLab
1. Create a GitHub/GitLab issue or README
2. Paste the mermaid code in markdown
3. The diagram will render automatically
4. Take a screenshot

### Method 4: Command Line Tool
```bash
npm install -g @mermaid-js/mermaid-cli
mmdc -i use-case-diagram-visual.md -o use-case-diagram.png
```

## Simplified Actor-Use Case Matrix

| Use Case | Guest | Student | Admin |
|----------|-------|---------|-------|
| View Home Page | ✓ | ✓ | ✓ |
| View Admission Info | ✓ | ✓ | ✓ |
| Register Account | ✓ | ✓ | - |
| Login to System | - | ✓ | ✓ |
| View Profile | - | ✓ | - |
| Update Profile | - | ✓ | - |
| Logout | - | ✓ | ✓ |
| View Test Credentials | - | ✓ | - |
| Access Admin Panel | - | - | ✓ |
| View Dashboard | - | - | ✓ |
| Manage Applicants | - | - | ✓ |
| View Applicant Details | - | - | ✓ |
| Delete Applicant | - | - | ✓ |
| Export Data | - | - | ✓ |

## Key Features Highlighted

### 🔐 Authentication Flow
- **Registration Required**: Users must register before login
- **Auto-login**: Successful registration automatically logs in user
- **Session Management**: Proper login/logout functionality

### 👨‍💼 Administrative Features  
- **Admin Dashboard**: Overview of system statistics
- **Data Management**: View, delete, and export applicant data
- **User Management**: Complete CRUD operations

### 🎓 Student Features
- **Profile Management**: View and update personal information
- **Secure Access**: Phone number + last 4 digits authentication
- **Test Environment**: Demo credentials for testing

### 🌐 Public Access
- **Information Pages**: Home and admission information
- **Registration Portal**: Easy account creation process