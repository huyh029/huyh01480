package tools;

import javafx.scene.control.Label;
import javafx.scene.layout.Pane;
import javafx.scene.paint.Color;
import javafx.scene.shape.Rectangle;

public class Card extends Pane {
    private String rank; // Giá trị của lá bài: A, 2, 3, ..., K
    private String suit; // Chất của lá bài: ♠, ♥, ♦, ♣
    private Rectangle cardRectangle;
    public String getRank() {
		return rank;
	}
	public void setRank(String rank) {
		this.rank = rank;
	}
	public String getSuit() {
		return suit;
	}
	public void setSuit(String suit) {
		this.suit = suit;
	}
	public Card(String rank, String suit,boolean basic) {
		this.rank = rank;
        this.suit = suit;
        double cardWidth = 70;
        double cardHeight = 40;
        setMaxSize(100, 120);
        cardRectangle = new Rectangle(cardWidth, cardHeight);
        cardRectangle.setArcWidth(15);
        cardRectangle.setArcHeight(15);
        cardRectangle.setFill(Color.WHITE); 
        cardRectangle.setStroke(Color.BLACK); 
        Label rankLabel = new Label(rank);
        rankLabel.setStyle("-fx-font-size: 20px; -fx-font-weight: bold;");
        rankLabel.setTextFill(isRedSuit(suit) ? Color.RED : Color.BLACK);
        rankLabel.setLayoutX(10); 
        rankLabel.setLayoutY(5); 
        Label topRightSuitLabel = new Label(suit);
        topRightSuitLabel.setStyle("-fx-font-size: 20px;");
        topRightSuitLabel.setTextFill(isRedSuit(suit) ? Color.RED : Color.BLACK);
        topRightSuitLabel.setLayoutX(cardWidth - 25); // Căn phải
        topRightSuitLabel.setLayoutY(5); // Căn trên
        getChildren().addAll(cardRectangle, rankLabel,topRightSuitLabel);
        setPrefSize(cardWidth, cardHeight);
	}
	public Card(String rank, String suit) {
        this.rank = rank;
        this.suit = suit;
        // Kích thước lá bài
        double cardWidth = 100;
        double cardHeight = 120;
        setMaxSize(100, 120);
        // Tạo hình chữ nhật đại diện cho lá bài
        cardRectangle = new Rectangle(cardWidth, cardHeight);
        cardRectangle.setArcWidth(15); // Bo tròn góc
        cardRectangle.setArcHeight(15);
        cardRectangle.setFill(Color.WHITE); // Nền trắng
        cardRectangle.setStroke(Color.BLACK); // Viền đen

        // Label hiển thị rank (giá trị)
        Label rankLabel = new Label(rank);
        rankLabel.setStyle("-fx-font-size: 20px; -fx-font-weight: bold;");
        rankLabel.setTextFill(isRedSuit(suit) ? Color.RED : Color.BLACK);
        rankLabel.setLayoutX(10); // Căn trái
        rankLabel.setLayoutY(5); // Căn trên

        // Label hiển thị suit (chất) lớn giữa bài
        Label suitLabel = new Label(suit);
        suitLabel.setStyle("-fx-font-size: 100px; -fx-font-weight: bold;");
        suitLabel.setTextFill(isRedSuit(suit) ? Color.RED : Color.BLACK);
        suitLabel.setLayoutX(20); // Căn giữa theo chiều ngang
        suitLabel.setLayoutY(0); // Căn giữa theo chiều dọc

        // Label hiển thị suit nhỏ góc trên phải
        Label topRightSuitLabel = new Label(suit);
        topRightSuitLabel.setStyle("-fx-font-size: 20px;");
        topRightSuitLabel.setTextFill(isRedSuit(suit) ? Color.RED : Color.BLACK);
        topRightSuitLabel.setLayoutX(cardWidth - 25); // Căn phải
        topRightSuitLabel.setLayoutY(5); // Căn trên

        // Label hiển thị suit nhỏ góc dưới trái
        Label bottomLeftSuitLabel = new Label(suit);
        bottomLeftSuitLabel.setStyle("-fx-font-size: 20px;");
        bottomLeftSuitLabel.setTextFill(isRedSuit(suit) ? Color.RED : Color.BLACK);
        bottomLeftSuitLabel.setLayoutX(10); // Căn trái
        bottomLeftSuitLabel.setLayoutY(cardHeight - 30); // Căn dưới

        // Thêm các phần tử vào Pane
        getChildren().addAll(cardRectangle, rankLabel, suitLabel, topRightSuitLabel, bottomLeftSuitLabel);

        // Đặt kích thước của Pane
        setPrefSize(cardWidth, cardHeight);
    }
	public void setBackgroundColor() {
		cardRectangle.setStyle("-fx-background-color: yellow");
	}
    private boolean isRedSuit(String suit) {
        return "♥".equals(suit) || "♦".equals(suit);
    }
    public String getCard() {
    	return rank+suit;
    }
}
