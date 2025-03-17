package com.example.calculator

import android.annotation.SuppressLint
import android.os.Bundle
import android.text.method.ScrollingMovementMethod
import android.widget.Button
import androidx.activity.ComponentActivity
import androidx.activity.enableEdgeToEdge
import android.widget.TextView
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
import com.example.calculator.ui.theme.CalculatorTheme
import java.math.BigDecimal
import java.math.MathContext
import java.math.RoundingMode



class MainActivity : ComponentActivity() {
    @SuppressLint("MissingInflatedId")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_main);
        setActAdd(findViewById<Button>(R.id.buttonZero),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonOne),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonTwo),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonThree),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonFour),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonFive),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonSix),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonSeven),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonEight),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonNine),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonDicimal),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonMultiplication),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonDivision),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonAddition),findViewById<TextView>(R.id.textViewOperation))
        setActAdd(findViewById<Button>(R.id.buttonSubtraction),findViewById<TextView>(R.id.textViewOperation))
        setActRemoveLast(findViewById<Button>(R.id.buttonBS),findViewById<TextView>(R.id.textViewOperation))
        setActRemoveChildLast(findViewById<Button>(R.id.buttonCE),findViewById<TextView>(R.id.textViewOperation))
        setActRemoveAll(findViewById<Button>(R.id.buttonC),findViewById<TextView>(R.id.textViewOperation),findViewById<TextView>(R.id.textViewResult))
        setActToggleSign(findViewById<Button>(R.id.buttonToggleSign),findViewById<TextView>(R.id.textViewOperation))
        findViewById<Button>(R.id.buttonEquality).setOnClickListener{
            var result = formatScientificNotation(calculate(findViewById<TextView>(R.id.textViewOperation).text.toString()))
            findViewById<TextView>(R.id.textViewResult).text = result?.toString() ?: "Math error"
        }
    }
}
private fun setActAdd(button : Button,textView: TextView) {
    button.setOnClickListener {
        textView.text = textView.text.toString() + button.text
        textView.movementMethod = ScrollingMovementMethod()
        textView.post {
            val layout = textView.layout
            if (layout != null) {
                val scrollAmount = layout.getLineTop(textView.lineCount) - textView.height
                textView.scrollTo(0, maxOf(scrollAmount, 0))
            }
        }
    }
}
private fun setActRemoveChildLast(button : Button,textView: TextView) {
    button.setOnClickListener {
        var text = textView.text.toString()
        if (text.isNotEmpty()) {
            if(!isNumber(text.last())) textView.text = text.dropLast(1)
            else {
                while (text.isNotEmpty()&&isNumber(text.last())) text = text.dropLast(1)
                textView.text = text
            }
        }
    }
}
private fun setActToggleSign(button : Button,textView: TextView) {
    button.setOnClickListener {
        var text = textView.text.toString()
        if (text.isNotEmpty()) {
            if(!isNumber(text.last())) {}
            else {
                var indexToggle = text.length-1
                while (indexToggle>=0 && isNumber(text[indexToggle])) indexToggle--
                println(indexToggle)
                if(indexToggle<0){
                    if(isNumber(text[0])){
                        textView.text = "-$text"
                    } else if(text[0]=='-'){
                        textView.text = text.substring(1)
                    } else if(text[0]=='+'){
                        textView.text = "-${text.substring(1,text.length)}"
                    }
                }else{
                    if(text[indexToggle] in "x/"){
                        var text1 = text.substring(0,indexToggle+1)
                        var text2 = text.substring(indexToggle+1,text.length)
                        textView.text = "$text1-$text2"
                    } else if(text[indexToggle]=='-'){
                        var text1 = text.substring(0,indexToggle)
                        var text2 = text.substring(indexToggle+1,text.length)
                        if(indexToggle>0&& !isNumber(text[indexToggle-1])) textView.text = "$text1$text2"
                        else textView.text = "$text1+$text2"
                    } else if(text[indexToggle]=='+'){
                        var text1 = text.substring(0,indexToggle)
                        var text2 = text.substring(indexToggle+1,text.length)
                        textView.text = "$text1-$text2"
                    }
                }
            }
        }
    }
}
private fun setActRemoveLast(button : Button,textView: TextView) {
    button.setOnClickListener {
        val text = textView.text.toString()
        if (text.isNotEmpty()) {
            textView.text = text.dropLast(1)
        }
    }
}

private fun setActRemoveAll(button : Button,textView: TextView,textView1: TextView) {
    button.setOnClickListener {
        textView.text = ""
        textView1.text ="0"
    }
}

fun calculate(expression: String): BigDecimal? {
    var begin : Int = 0;
    val operation = ArrayDeque<Any>()
    for (i in 0 until expression.length-1){
        if(isNumber(expression[i]) && !isNumber(expression[i+1])){
            var value : BigDecimal = toNumber(expression.substring(begin, i + 1))?: return null
            operation.addLast(value)
            if(isValidOperators(expression[i+1]) == false) return null
            else operation.addLast(expression[i+1])
            begin = i + 2
        }
    }
    var value : BigDecimal = toNumber(expression.substring(begin, expression.length))?: return null
    operation.addLast(value)
    println(operation)
    var queue = ArrayDeque<Any>()
    var validOperator = ArrayDeque<Char>()

    while (operation.isNotEmpty()){
        var tmp = operation.removeFirst()
        if(tmp is BigDecimal) queue.addLast(tmp)
        else{
            if(validOperator.isEmpty() ||( degreeValidOperator(validOperator.last()) < degreeValidOperator(tmp as Char)))
                validOperator.addLast(tmp as Char)
            else if( degreeValidOperator(validOperator.last()) == degreeValidOperator(tmp as Char)){
                queue.addLast(validOperator.removeLast())
                validOperator.addLast(tmp)
            }
            else {
                while (validOperator.isNotEmpty()){
                    queue.addLast(validOperator.removeLast())
                }
                validOperator.addLast(tmp)
            }
        }
    }

    while (validOperator.isNotEmpty()) {
        queue.addLast(validOperator.removeLast())
    }

    println(queue)
    while (queue.isNotEmpty()){
        var tmp = queue.removeFirst()
        if(tmp is Char) {
            var number1 = operation.removeLast()
            var number2 = operation.removeLast()
            operation.addLast(calculate(number1 as BigDecimal,number2 as BigDecimal,tmp)?:return null)
        }
        else{
            operation.addLast(tmp)
        }
    }
    return operation.removeLast() as BigDecimal
}

private fun calculate(number1 : BigDecimal,number2: BigDecimal ,char : Char) : BigDecimal?{
    try {
        if(char=='+') return  number1.add(number2)
        else if(char == '-') return number2.subtract(number1)
        else if(char == 'x') return number2.multiply(number1)
        else if(char == '/') return  if (number1 == BigDecimal.ZERO) null else number2.divide(number1,200,RoundingMode.HALF_UP)
    } catch (e : NumberFormatException){
        return null
    }
    return null
}

private fun isValidOperators(char: Char): Boolean {
    return char in "+-x/"
}

private fun toNumber(string: String) : BigDecimal?{
    var result = string.replace("+","")
    result = result.replace("--","")
    try {
        var number = BigDecimal(result)
       return number
    }
    catch(e : NumberFormatException){
        return null
    }
    return null
}
private fun isNumber(char: Char): Boolean {
    return char in '0'..'9' || char == '.'
}
private fun degreeValidOperator(char : Char) : Int{
    if(char in "+-") return 1
    else if(char in "x/") return 2
    return 0
}

private fun formatScientificNotation(number: BigDecimal?): String? {
    val max = BigDecimal.TEN.pow(200)
    return when {
        number == null -> null
        number.abs() >= max -> "exceed the limt"
       // number.precision() >= 10 -> number.toEngineeringString()
        else -> {
            val roundedNum = number.round(MathContext(8))
            roundedNum.toEngineeringString()
        }
    }
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
    CalculatorTheme {
        Greeting("Android")
    }
}