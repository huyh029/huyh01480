package com.example.currency

import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.view.View
import android.view.inputmethod.EditorInfo
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.EditText
import android.widget.Spinner
import android.widget.TextView
import android.widget.Toast
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.activity.enableEdgeToEdge
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
import com.example.currency.ui.theme.CurrencyTheme
var valueCurrency1 : Double = 1.0;
var valueCurrency2 : Double = 1.0;
class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_main);
        var currency1 : Spinner = findViewById<Spinner>(R.id.currency1)
        var currency2 : Spinner = findViewById<Spinner>(R.id.currency2)

        val value1 = findViewById<EditText>(R.id.value1)
        val value2 = findViewById<TextView>(R.id.value2)
        var items1 = listOf(
            "USD (Đô la Mỹ)",
            "EUR (Euro)",
            "JPY (Yên Nhật)",
            "GBP (Bảng Anh)",
            "VND (Việt Nam Đồng)"
        )
        var items2 = listOf(
            "USD (Đô la Mỹ)",
            "EUR (Euro)",
            "JPY (Yên Nhật)",
            "GBP (Bảng Anh)",
            "VND (Việt Nam Đồng)"
        )
        val adapter1 = ArrayAdapter(this, R.layout.list_form, items1)
        adapter1.setDropDownViewResource(R.layout.list_form)
        val adapter2 = ArrayAdapter(this, R.layout.list_form, items2)
        adapter2.setDropDownViewResource(R.layout.list_form)
        currency1.adapter = adapter1
        currency2.adapter = adapter2
        currency1.onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onItemSelected(parent: AdapterView<*>, view: View?, position: Int, id: Long) {
                val selectedItem = parent.getItemAtPosition(position).toString()
                Toast.makeText(this@MainActivity, "Bạn chọn: $selectedItem", Toast.LENGTH_SHORT).show()
                when(selectedItem){
                    "USD (Đô la Mỹ)" -> valueCurrency1 = 1.0
                    "EUR (Euro)" -> valueCurrency1 = 1.09
                    "JPY (Yên Nhật)" -> valueCurrency1 = 0.0067
                    "GBP (Bảng Anh)" -> valueCurrency1 = 1.26
                    "VND (Việt Nam Đồng)" -> valueCurrency1 = 0.000039
                }
                convert(value2,value1)
            }

            override fun onNothingSelected(parent: AdapterView<*>) {

            }
        }
        currency2.onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onItemSelected(parent: AdapterView<*>, view: View?, position: Int, id: Long) {
                val selectedItem = parent.getItemAtPosition(position).toString()
                Toast.makeText(this@MainActivity, "Bạn chọn: $selectedItem", Toast.LENGTH_SHORT).show()
                when(selectedItem){
                    "USD (Đô la Mỹ)" -> valueCurrency2 = 1.0
                    "EUR (Euro)" -> valueCurrency2 = 1.09
                    "JPY (Yên Nhật)" -> valueCurrency2 = 0.0067
                    "GBP (Bảng Anh)" -> valueCurrency2 = 1.26
                    "VND (Việt Nam Đồng)" -> valueCurrency2 = 0.000039
                }
                convert(value2,value1)
            }

            override fun onNothingSelected(parent: AdapterView<*>) {

            }
        }


        value1.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) {}

            override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) {
                convert(value2,value1)
            }

            override fun afterTextChanged(s: Editable?) {}
        })


    }
}
fun convert(textView: TextView,editText: EditText){
    var s = editText.text
    textView.text = ((if (s.isNullOrEmpty()) 0.0 else s.toString().toDouble()) * valueCurrency1/valueCurrency2).toString()
}
@Composable
fun Greeting(name: String, modifier: Modifier = Modifier) {
    Text(
        text = "Hello $name!",
        modifier = modifier
    )
}

@Preview(showBackground = true)
@Composable
fun GreetingPreview() {
    CurrencyTheme {
        Greeting("Android")
    }
}