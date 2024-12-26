package tools;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

import java.util.Collections;

import gameLogic.LogicGame;
import gameLogic.LogicTienLenMienBac;

public class AI extends Player {
    private LogicGame logic;
    private boolean foundNewCard;
    private ObservableList<Card> newCard;

    public AI(LogicGame logic) {
        this.logic = logic;
    }

    public ObservableList<Card> getNewCard(ObservableList<Card> cards, ObservableList<Card> oldCard) {
        foundNewCard = false;
        newCard = FXCollections.observableArrayList();
        int index = 0;
        if(oldCard.isEmpty()) {
        	if(cards.size()>6) {
        		ObservableList<Card> tmpCard1 = sort2(cards,oldCard);
        		ObservableList<Card> tmpCard2 = sort3(cards,oldCard);
        		if(tmpCard1.size()>1) {
        			if(tmpCard2.size()>1) {
        				if(getValueRank(tmpCard2.get(0))<getValueRank(tmpCard1.get(0))) return tmpCard2;
        				else return tmpCard1;
        			}
        			else {
        				return tmpCard1;
        			}
        		}
        		else {
        			if(tmpCard2.size()>1) {
        				return tmpCard2;
        			}
        			else {
        				newCard.clear();
        	        	newCard.add(cards.get(0));
        			}
        		}
        	}
        	else {
        		newCard.clear();
        		newCard.addAll(cards);
        		while(!logic.check(newCard, oldCard)) {
            		newCard.removeLast();
            	}
        	}
        	return newCard;
        }
        findNewCard(0, cards, oldCard);
        return newCard;
    }

    private void findNewCard(int index, ObservableList<Card> cards, ObservableList<Card> oldCard) {
    	 if (foundNewCard || index >= cards.size() ) {
             return;
         }
         for (int i = index; i < cards.size(); i++) {
         	if (!foundNewCard) {
         		newCard.add(cards.get(i));
             }
             if (logic.check(newCard, oldCard)) {
                 foundNewCard = true;
                 return; 
             }
             else {
 	            findNewCard(i + 1, cards, oldCard);
 	            if (!foundNewCard) {
 	                newCard.remove(cards.get(i));
 	            }
             }
             
         }
    }
    public boolean compare(Card card1,Card card2) {
		if(getValueRank(card1)<getValueRank(card2)) return true;
		if(getValueRank(card2)<getValueRank(card1)) return false;
		if(getValueSuit(card1)<getValueSuit(card2)) return true;
		return false;
	}
	private int getValueRank(Card card) {
		String[] ranks = {"3","4","5","6","7","8","9","10","J","Q","K","A","2"};
		for(int i=0;i<12;i++) {
			if(card.getRank().equals(ranks[i])) return i;
		}
		return 13;
	}
	private int getValueSuit(Card card) {
		String[] suits = { "♥", "♦", "♣","♠"};
		for(int i=0;i<4;i++) {
			if(card.getSuit().equals(suits[i])) return (3-i);
		}
		return -1;
	}
	private int compareRank(Card card1, Card card2) {
		if(getValueRank(card1) < getValueRank(card2) ) return -1;
		if(getValueRank(card1) > getValueRank(card2) ) return 1;
		return 0;
	}
	private int compareSuit(Card card1, Card card2) {
		if(getValueSuit(card1) < getValueSuit(card2) ) return -1;
		if(getValueSuit(card1) > getValueSuit(card2) ) return 1;
		return 0;
	}
	private boolean compareColor(Card card1, Card card2) {
		return getValueSuit(card1)/2==getValueSuit(card2)/2;
	}
    private void sort1(ObservableList<Card> cards) {
    	 for (int i = 0; i < cards.size(); i++) {
             for (int j = 0; j < i; j++) {
                 if (compare(cards.get(i), cards.get(j))) {
                     Collections.swap(cards, j, i);
                 }
             }
         }
    }
    private ObservableList<Card> sort2(ObservableList<Card> cards, ObservableList<Card> oldCard) {
    	sort1(cards);
    	ObservableList<Card> tmp = FXCollections.observableArrayList();
    	ObservableList<Card> newCard = FXCollections.observableArrayList();
    	for(int i=0 ; i<cards.size()-1 ; i++) {
    		while(i<cards.size()-1&&compareRank(cards.get(i), cards.get(i+1))==0) {
    			tmp.add(cards.get(i+1));
    			cards.remove(cards.get(i+1));
    		}
    	}
    		while(cards.size()>=3&&getValueRank(cards.get(0))!=getValueRank(cards.get(2))-2) {
    			tmp.add(cards.get(0));
    			cards.remove(cards.get(0));
    		}
    	cards.addAll(tmp);
    	newCard.addAll(cards);
    	while(!logic.check(newCard, oldCard)) {
    		newCard.removeLast();
    	}
    	sort1(cards);
    	return newCard;
   }
    private ObservableList<Card> sort3(ObservableList<Card> cards, ObservableList<Card> oldCard) {
    	sort1(cards);
    	ObservableList<Card> tmp = FXCollections.observableArrayList();
    	ObservableList<Card> newCard = FXCollections.observableArrayList();
    	while(cards.size()>=2&&getValueRank(cards.get(0))!=getValueRank(cards.get(1))) {
    			tmp.add(cards.get(0));
    			cards.remove(cards.get(0));
    		}
    	cards.addAll(tmp);
    	newCard.addAll(cards);
    	while(!logic.check(newCard, oldCard)) {
    		newCard.removeLast();
    	}
    	sort1(cards);
    	return newCard;
   }
}

