package com.example.studentmanager

import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.BaseAdapter
import android.widget.TextView

class StudentAdapter(private val context: Context, private val students: List<Student>) : BaseAdapter() {

    override fun getCount(): Int = students.size

    override fun getItem(position: Int): Any = students[position]

    override fun getItemId(position: Int): Long = position.toLong()

    override fun getView(position: Int, convertView: View?, parent: ViewGroup?): View {
        val view = convertView ?: LayoutInflater.from(context).inflate(R.layout.item_student, parent, false)

        val tvName: TextView = view.findViewById(R.id.tvName)
        val tvMSSV: TextView = view.findViewById(R.id.tvMSSV)

        val student = students[position]
        tvName.text = student.name
        tvMSSV.text = student.mssv

        return view
    }
}
