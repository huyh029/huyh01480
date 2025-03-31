package com.example.studentmanager

import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import com.example.studentmanager.ui.theme.StudentManagerTheme

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            StudentManagerTheme {
                StudentManagerApp()
            }
        }
    }
}

// Data class cho sinh viên


// Composable chính
@Composable
fun StudentManagerApp() {
    var students by remember { mutableStateOf(listOf(
        Student("Nguyễn Văn A", "20220000"),
        Student("Trần Thị B", "20220001"),
        Student("Lê Văn C", "20220002")
    )) }

    var newName by remember { mutableStateOf("") }
    var newMSSV by remember { mutableStateOf("") }
    var selectedStudent by remember { mutableStateOf<Student?>(null) }

    Scaffold(
        modifier = Modifier.fillMaxSize(),
    ) { paddingValues ->
        Column(modifier = Modifier.padding(paddingValues).padding(16.dp)) {

            // Danh sách sinh viên
            LazyColumn(
                modifier = Modifier.weight(1f)
            ) {
                items(students) { student ->
                    StudentItem(student)
                }
            }

            // Form nhập sinh viên mới
            OutlinedTextField(
                value = newName,
                onValueChange = { newName = it },
                label = { Text("Họ tên") },
                modifier = Modifier.fillMaxWidth().padding(top = 8.dp)
            )

            OutlinedTextField(
                value = newMSSV,
                onValueChange = { newMSSV = it },
                label = { Text("MSSV") },
                modifier = Modifier.fillMaxWidth().padding(top = 8.dp)
            )

            Button(
                onClick = {
                    if (newName.isNotBlank() && newMSSV.isNotBlank()) {
                        students = listOf(Student(newName, newMSSV)) + students
                        newName = ""
                        newMSSV = ""
                    }
                },
                modifier = Modifier.fillMaxWidth().padding(top = 8.dp)
            ) {
                Text("Thêm Sinh Viên")
            }

            // DropdownMenu (Spinner) để chọn sinh viên cần xóa
            if (students.isNotEmpty()) {
                var expanded by remember { mutableStateOf(false) }

                Box(modifier = Modifier.fillMaxWidth().padding(top = 8.dp)) {
                    Button(onClick = { expanded = true }, modifier = Modifier.fillMaxWidth()) {
                        Text(selectedStudent?.name ?: "Chọn sinh viên để xóa")
                    }

                    DropdownMenu(expanded = expanded, onDismissRequest = { expanded = false }) {
                        students.forEach { student ->
                            DropdownMenuItem(
                                text = { Text(student.name) },
                                onClick = {
                                    selectedStudent = student
                                    expanded = false
                                }
                            )
                        }
                    }
                }

                Button(
                    onClick = {
                        selectedStudent?.let {
                            students = students.filter { it != selectedStudent }
                            selectedStudent = null
                        }
                    },
                    modifier = Modifier.fillMaxWidth().padding(top = 8.dp),
                    enabled = selectedStudent != null
                ) {
                    Text("Xóa Sinh Viên")
                }
            }
        }
    }
}

// Item sinh viên
@Composable
fun StudentItem(student: Student) {
    Card(
        modifier = Modifier.fillMaxWidth().padding(4.dp),
        elevation = CardDefaults.cardElevation(4.dp)
    ) {
        Row(modifier = Modifier.padding(8.dp)) {
            Text(student.name, modifier = Modifier.weight(1f))
            Text(student.mssv)
        }
    }
}

// Preview
@Preview(showBackground = true)
@Composable
fun PreviewStudentManager() {
    StudentManagerTheme {
        StudentManagerApp()
    }
}
